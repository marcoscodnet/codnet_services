<?php
namespace Cose\Security\model\listeners;


use Cose\Security\model\NewPasswordRequest;

use Cose\model\impl\Entity;

/**
 * NewPasswordRequestListener
 *  
 * Interfaz utilizada para indicar que una clave fue solicitada.
 *  
 * @author bernardo
 * 
 */
interface INewPasswordRequestListener {

	/**
	 * se envía un email notificando el request.
	 * 
	 * @param NewPasswordRequest $request
	 */
	function sendNewPasswordRequestEmail(NewPasswordRequest $request);
	
	/**
	 * se envía un email confirmando el cambio de password.
	 * 
	 * @param NewPasswordRequest $request
	 */
	function sendNewPasswordConfirmedEmail(NewPasswordRequest $request);
}
