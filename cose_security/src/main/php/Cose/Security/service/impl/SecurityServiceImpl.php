<?php
namespace Cose\Security\service\impl;

use Cose\Security\utils\SecurityUtils;

use Cose\Security\service\ServiceFactory;
use Cose\Security\annotation\CoseSecurity;
use Cose\Security\model\User, 
	Cose\Security\service\ISecurityService,
	Cose\Security\service\SecurityContext,
	Cose\Security\exception\InvalidPasswordException;

use Cose\utils\ReflectionUtils;
use Cose\utils\Logger;

use Cose\exception\ServiceException,
	Cose\exception\DAOException,
	Cose\service\impl\Service,
	Cose\service\IService;

use Addendum\ReflectionAnnotatedClass;
use Addendum\ReflectionAnnotatedMethod;
	
/**
 * Interface para los servicios de seguridad
 * 
 * @author bernardo
 *
 */
class SecurityServiceImpl extends Service implements ISecurityService{

	/**
	 * (non-PHPdoc)
	 * @see service/impl/Cose\service\impl.Service::getDAO()
	 */
	protected function getDAO(){}
	
	/**
	 * (non-PHPdoc)
	 * @see Cose\service.ISecurityService::authenticate()
	 */
	function authenticate( $username, $password ){

		
		
		//throw new ServiceException("autenticando $username, $password");
		
		$userService = ServiceFactory::getUserService();
    	
		$user = $userService->getUserByUsername($username);
		
		/*$encryptedPassword = SecurityUtils::aesEncrypt($password);
		Logger::log('Pass: '.$encryptedPassword .' => '.$user->getPassword());
		if( $encryptedPassword != $user->getPassword() )
			throw new InvalidPasswordException();	*/		
    	//$encryptedPassword = SecurityUtils::aesEncrypt($password);
		
		$decryptedPassword = SecurityUtils::aesDecrypt($user->getPassword());
		Logger::log('Pass: '.$decryptedPassword .' => '.$user->getPassword());
		if( $decryptedPassword != $password )
			throw new InvalidPasswordException();		
		
			
		$user->setLogged( true );
		$user->setLastLogin( new \DateTime() );
		$user->setLoginFrom( $this->getLocalIpv4() );
//		$user->decrypt();
		$userService->update( $user );		

		$user->getGroups();
		
		return $user;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Cose\service.ISecurityService::authorize()
	 */
	function authorize( User $user=null, IService $service, $method="" ){
		
		//Logger::log( "autorizando $method on " . get_class($service) , __CLASS__);
		
		$authorize = true;

		//chequeamos si el servicio necesita permisos.
		$servicePermission = $this->getServicePermission($service);
		
		//chequeamos si el método necesita persmisos adicionales.
		$methodPermission = $this->getMethodPermission($service, $method);
		
		//chequeando permiso
		if(!empty($servicePermission)){
			$authorize = $user->hasPermissionByName($servicePermission);
		}
		
		if(!empty($methodPermission)){
			$authorize = $user->hasPermissionByName($methodPermission);
		}
		
		return $authorize;
	}
	
	/* 
	 *  se obtiene el permiso para ejecutar un servicio
	 *  null si no tiene permiso asociado.
	 */
	private function getServicePermission($service){

		$permission = null;
		
		$reflectionClass = new ReflectionAnnotatedClass(get_class($service));
		
		if( $reflectionClass->hasAnnotation("Cose\Security\annotation\Secured") ){
				
			//obtenemos el annotation y vemos si se requiere un permiso o un rol.
			$secured = $reflectionClass->getAnnotation("Secured");
			$permission = $secured->permission;

			Logger::logObject($permission, __CLASS__);
		}
		
		return $permission;
	}
	
	/*
	 * se obtiene el permiso para ejecutar un método de un servicio
	 * null si no tiene permiso asociado.
	 */
	private function getMethodPermission($service, $method){

		$permission = null;
		
		$reflectionMethod = new ReflectionAnnotatedMethod(get_class($service), $method);
		
		if( $reflectionMethod->hasAnnotation("Cose\Security\annotation\Secured") ){
				
			//obtenemos el annotation y vemos si se requiere un permiso o un rol.
			$secured = $reflectionMethod->getAnnotation("Secured");
			$permission = $secured->permission;
				
		}
		
		return $permission;
	}
	

	private function getLocalIpv4() {
 		/*$out = split(PHP_EOL,shell_exec("/sbin/ifconfig"));
  		$local_addrs = array();
  		$ifname = 'unknown';
  		foreach($out as $str) {
    		$matches = array();
    		if(preg_match('/^([a-z0-9]+)(:\d{1,2})?(\s)+Link/',$str,$matches)) {
      			$ifname = $matches[1];
      			if(strlen($matches[2])>0) {
        			$ifname .= $matches[2];
      			}
    		} elseif(preg_match('/inet addr:((?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3})\s/',$str,$matches)) {
      			$local_addrs[$ifname] = $matches[1];
    		}
  		}
  		
  		return implode(",", $local_addrs);
  		*/
		return "";
	}
		
	/**
	 * (non-PHPdoc)
	 * @see Cose\service.ISecurityService::logout()
	 */
	function logout($username ){

		$userService = ServiceFactory::getUserService();
		$user = $userService->getUserByUsername($username);
		
		$user->setLogged( false );
			
		$userService->update( $user );		
			
		return $user;
	}

}