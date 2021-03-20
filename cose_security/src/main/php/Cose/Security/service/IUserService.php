<?php
namespace Cose\Security\service;

use Cose\Security\model\listeners\INewPasswordRequestListener;

use Cose\Crud\service\ICrudService;

/**
 * interfaz para el servicio de user
 *  
 * @author bernardo
 *
 */
interface IUserService extends ICrudService {
	
	/**
	 * Recupera un usuario dado el username
	 * @param $username
	 * 
	 * @throws ServiceException
	 */
	function getUserByUsername($username);
	
	/**
	 * se actualiza la password de un usuario
	 * @param $username
	 * @param $newPassword
	 * @param $oldPassword
	 * 
	 * @throws ServiceException
	 */
	function updatePassword( $username, $newPassword, $oldPassword  );
	
	/**
	 * se realiza la solicitud de una nueva password.
	 * @param $username
	 * @param $listener
	 *  
	 * @throws ServiceException
	 */
	function getNewPassword( $username, INewPasswordRequestListener $listener=null );
	
	
	/**
	 * obtiene un request de password dado su código
	 * de validación.
	 * 
	 * @param $validationCode
	 *  
	 * @throws ServiceException
	 */
	function getNewPasswordRequestByValidationCode( $validationCode );
	
	
	/**
	 * se confirma el cambio de clave
	 * @param $validationCode
	 * @param $password
	 */
	function confirmNewPasswordRequest( $validationCode, $password, INewPasswordRequestListener $listener=null );
}