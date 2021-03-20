<?php
namespace Cose\Catalogo\service;

/**
 * Factory de servicios
 *  
 * @author bernardo
 *
 */

use Cose\Catalogo\service\impl\GeneroServiceImpl;

use Cose\Catalogo\service\impl\EstadoCivilServiceImpl;

use Cose\Catalogo\service\impl\CondicionIvaServiceImpl;

use Cose\Catalogo\service\impl\TipoDocumentoServiceImpl;

class ServiceFactory {
	
	/**
	 * @return ITipoDocumentoService
	 */
	public static function getTipoDocumentoService(){
	
		return new TipoDocumentoServiceImpl();	
	}

	/**
	 * @return ICondicionIvaService
	 */
	public static function getCondicionIvaService(){
	
		return new CondicionIvaServiceImpl();	
	}
	
	/**
	 * @return IEstadoCivilService
	 */
	public static function getEstadoCivilService(){
	
		return new EstadoCivilServiceImpl();	
	}
	
	/**
	 * @return IGeneroService
	 */
	public static function getGeneroService(){
	
		return new GeneroServiceImpl();
	}
	
	
}