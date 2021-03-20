<?php

namespace Cose\Security\service;



/**
 * Contexto de seguridad para los servicios.
 * 
 * @author bernardo
 * @since 14/09/2012
 * 
 */

use Cose\Security\exception\PermissionNotFoundException;

use Cose\Security\service\impl\SecurityServiceImpl;
use Rasty\utils\Logger;
use Cose\utils\ReflectionUtils,
	Cose\service\IService;

	
	
class SecurityContext {
	
	/**
	 * instancia singleton
	 * @var SecurityContext
	 */
	private static $instance;
	
	/**
	 * @var ISecurityService
	 */
	private $securityService;
	
	/**
	 * usuario autenticado.
	 * @var IUser
	 */
	private $user;
	
	
	/**
	 * instancia singleton
	 */
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			if(!isset($_SESSION['securityContext'])){
				$_SESSION['securityContext'] = serialize( new SecurityContext() );
			}
			self::$instance = unserialize( $_SESSION['securityContext'] );
			
		}
		
		return self::$instance;
	}
	
	private function __construct() {
		
		$this->securityService = ServiceFactory::getSecurityService();
	}
	
	/**
	 * determina si se puede ejecutar el servicio indicado.
	 * @param string $service servicio a ejecutar.
	 * @return boolean
	 */
	public function authorize( IService $service, $method ) {
		
		return $this->securityService->authorize( $this->user, $service, $method );
	}
	
	/**
	 * se loguea el usuario en el contexto de seguridad
	 * @param $username nombre de usuario
	 * @param $password clave
	 * @throws ServiceException 
	 */
	function login( $username, $password ){
		$this->user = $this->securityService->authenticate( $username, $password );
		$_SESSION['securityContext'] = serialize( $this );
	}
	
	/**
	 * se desloguea el usuario en el contexto de seguridad
	 * @throws ServiceException 
	 */
	function logout(){
		
		$user = $this->user;
		
		if(!empty($user)){
		
			$this->securityService->logout( $this->user->getUsername() );	
		}
				
		
		$this->user = null;
		unset( $_SESSION['securityContext'] );
	}
	
	

	public function getUser()
	{
	    return $this->user;
	}

	public function setUser($user)
	{
	    $this->user = $user;
	}
	
	/**
	 * se cheque si el usuario cuenta con el permiso indicado
	 * @param $permission nombre del permiso
	 * @throws ServiceException 
	 */
	function checkPermissionByName( $permission){
		
		$has = false;
		try {
			
			$userService = ServiceFactory::getUserService();
			$user = $userService->getUserByUsername($this->user->getUsername());
			
			$has = $user->hasPermissionByName($permission);
			
			
			
			/*if(!$has){
	
				$permissionService = ServiceFactory::getPermissionService();
				$branch = $permissionService->getPermissionBranchByName($permission);
				Logger::logObject($branch, __CLASS__);
				foreach ($branch as $p) {
					if(strtoupper($p->getName())==strtoupper($permission))
						$has = true;
				}
			}*/
		} catch (PermissionNotFoundException $e) {
			$has = false;
		}
		
		//Logger::log('Tiene permiso: '.$has);
		
		return $has;
		
		
		
	}
	
}

?>