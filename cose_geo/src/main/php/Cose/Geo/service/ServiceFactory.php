<?php
namespace Cose\Geo\service;


/**
 * Factory de servicios
 *  
 * @author bernardo
 *
 */
use Cose\Geo\service\impl\DomicilioServiceImpl;

use Cose\Geo\service\impl\LocalidadServiceImpl;

use Cose\Geo\service\impl\ProvinciaServiceImpl;

use Cose\Geo\service\impl\PaisServiceImpl;

class ServiceFactory {
	
	/**
	 * @return IPaisService
	 */
	public static function getPaisService(){
	
		return new PaisServiceImpl();	
	}
	
	/**
	 * @return IProvinciaService
	 */
	public static function getProvinciaService(){
	
		return new ProvinciaServiceImpl();	
	}
	
	/**
	 * @return ILocalidadService
	 */
	public static function getLocalidadService(){
	
		return new LocalidadServiceImpl();	
	}

	/**
	 * @return IDomicilioService
	 */
	public static function getDomicilioService(){
	
		return new DomicilioServiceImpl();	
	}
	
	
}