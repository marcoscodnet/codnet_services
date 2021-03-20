<?php
namespace Cose\Workflow\service;


/**
 * Factory de servicios
 *  
 * @author bernardo
 *
 */

use Cose\Workflow\service\impl\CategoriaTareaServiceImpl;

use Cose\Workflow\service\impl\TareaServiceImpl;

class ServiceFactory {

	/**
	 * @return ICatalogoService
	 */
	public static function getCategoriaTareaService(){
	
		return new CategoriaTareaServiceImpl();	
	}
	
	/**
	 * @return ITareaService
	 */
	public static function getTareaService(){
	
		return new TareaServiceImpl();	
	}
		
	
}