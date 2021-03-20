<?php

/**
 * Excepci�n gen�rica para los DAOs.
 * 
 * @author bernardo
 * @since 14-03-2010
 */

namespace Cose\exception;

class ServiceNoResultException extends ServiceException{
	
	public function __construct($msg=null){
		if($msg==null)
			$msg = "no result";
		
		parent::__construct($msg);
	}
	
}
