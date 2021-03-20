<?php
namespace Cose\Security\service\impl;

use Cose\Security\utils\SecurityUtils;

use Cose\Security\criteria\NewPasswordRequestCriteria;

use Cose\Security\model\listeners\INewPasswordRequestListener;

use Cose\Security\conf\SecurityConfig;

use Cose\Security\model\NewPasswordRequest;

use Cose\Security\exception\UserNotFoundException;

use Cose\Security\criteria\UserCriteria;

use Cose\Security\dao\DAOFactory, 
	Cose\Security\service\IUserService;

use Cose\Crud\service\impl\CrudService;
use Cose\exception\DAOException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceException;

use Cose\utils\Logger;


/**
 * servicio para user
 *  
 * @author bernardo
 *
 */
class UserServiceImpl extends CrudService implements IUserService {
	
	
	protected function getDAO(){
		return DAOFactory::getUserDAO();
	}
	
	function validateOnAdd( $entity ){
	
		//que no exista otro user con mismo username.
		$username = $entity->getUsername();
		$criteria = new UserCriteria();
		$criteria->setUsername($username);
		$criteria->setOidNotEqual( $entity->getOid() );
		
		
		//Logger::log("oid del usuario " . $entity->getOid(), __CLASS__);
		
		$count = $this->getCount($criteria);
		
		if( $count > 0){
			throw new ServiceException( "user.add.username.repetead" );
		}
		
		
	}
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}
	
	
	/**
	 * (non-PHPdoc)
	 * @see service/Cose\Security\service.IUserService::getUserByUsername()
	 */
	function getUserByUsername($username){
	
		try{
			
			if(empty($username))
				throw new UserNotFoundException( $e->getMessage() );
			
			$criteria = new UserCriteria();
			$criteria->setUsername($username);
		
			$user = $this->getSingleResult( $criteria );
			
			return $user;
		
		} catch (ServiceNoResultException $e) {

			throw new UserNotFoundException( $e->getMessage() );
			
		} catch (\Exception $e) {
				
			throw new ServiceException( $e->getMessage() );
		}
		
	}

	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Cose/Security/service/Cose\Security\service.IUserService::updatePassword()
	 */
	function updatePassword( $username, $newPassword, $oldPassword  ){
	
		try{
			
			$user = $this->getUserByUsername($username);
		
			//chequeamos la password.
			$password = $user->getPassword();
			
			$encryptedNewPassword = SecurityUtils::aesEncrypt($newPassword);
			$encryptedOldPassword = SecurityUtils::aesEncrypt($oldPassword);
			
			if($password!=$encryptedOldPassword)
				throw new ServiceException( "user.password.invalid"  );
		
			//actualizamos la password.
			$user->setPassword( $encryptedNewPassword );
			$this->update($user);
				
		} catch (ServiceNoResultException $e) {

			throw new UserNotFoundException( $e->getMessage() );
			
		} catch (ServiceException $e) {
				
			//throw new ServiceException( $e->getMessage() );
			throw new UserNotFoundException( $e->getMessage() );
		} catch (\Exception $e) {
				
			throw new ServiceException( $e->getMessage() );
		}
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Cose/Security/service/Cose\Security\service.IUserService::getNewPassword()
	 */
	function getNewPassword( $username, INewPasswordRequestListener $listener=null ){
	
		try{
			
			$user = $this->getUserByUsername($username);

			//generamos la solicitud de la nueva clave.
			$request = new NewPasswordRequest();
			$request->setUser($user);
			$expirationDate = new \DateTime();
			$expirationDate->modify("+1 day");
			$request->setExpirationDate($expirationDate);
			$request->setValidationCode(md5(uniqid(rand())));
			
			DAOFactory::getNewPasswordRequestDAO()->add( $request );
			
			if($listener!=null)
				$listener->sendNewPasswordRequestEmail($request);
			
			
		} catch (ServiceNoResultException $e) {

			throw new UserNotFoundException( $e->getMessage() );
			
		} catch (\Exception $e) {
				
			throw new ServiceException( $e->getMessage() );
		}
		
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Cose/Security/service/Cose\Security\service.IUserService::getNewPasswordRequestByValidationCode()
	 */
	function getNewPasswordRequestByValidationCode( $validationCode ){

		$npr = false;
		
		try{
			
			if(!empty($validationCode)){
				
				$criteria = new NewPasswordRequestCriteria();
				$criteria->setValidationCode($validationCode);
			
				$npr =  DAOFactory::getNewPasswordRequestDAO()->getSingleResult( $criteria );
		
			}
			
		}catch (ServiceNonUniqueResultException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
		
		}catch (ServiceException $ex){
		
		}catch (\Exception $ex){
			\Logger::getLogger(__CLASS__)->info("error buscando por código de validación. " . $ex->getMessage());
		}
		
		return $npr;	
	}
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Cose/Security/service/Cose\Security\service.IUserService::confirmNewPasswordRequest()
	 */
	function confirmNewPasswordRequest( $validationCode, $password, INewPasswordRequestListener $listener=null ){
	
		$npr = false;
		
		try{
			
			if(!empty($validationCode)){
				
				$criteria = new NewPasswordRequestCriteria();
				$criteria->setValidationCode($validationCode);
			
				$npr =  DAOFactory::getNewPasswordRequestDAO()->getSingleResult( $criteria );
		
				$encryptedPassword = SecurityUtils::aesEncrypt($password);
				
				$user = $npr->getUser();
				$user->setPassword( $encryptedPassword );
				
				\Logger::getLogger(__CLASS__)->info("confirmando cambio de clave: $password");
				
				$this->update( $user );
				//$this->getDAO()->update( $user );
				
				DAOFactory::getNewPasswordRequestDAO()->delete( $npr->getOid() );
				
				if($listener!=null)
					$listener->sendNewPasswordConfirmedEmail($request);
				
			}
			
		}catch (ServiceNonUniqueResultException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
		
		}catch (ServiceException $ex){
		
		}catch (\Exception $ex){
			\Logger::getLogger(__CLASS__)->info("error buscando por código de validación. " . $ex->getMessage());
		}
		
		return $npr;
	}
}