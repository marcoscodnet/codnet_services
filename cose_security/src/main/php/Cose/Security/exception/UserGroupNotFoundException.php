<?php
namespace Cose\Security\exception;

use Cose\exception\ServiceException;

/**
 * Excepción que indica que el userGroup no fue encontrado.
 * 
 * @author bernardo
 * @since 05-11-2014
 */


class UserGroupNotFoundException extends ServiceException{
	
	public function __construct($msg=null){
		if($msg==null)
			$msg = "userGroup not found";
		
		parent::__construct($msg);
	}
	
}
