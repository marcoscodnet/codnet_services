<?php
namespace Cose\Catalogo\dao;


/**
 * Factory de DAOs
 *  
 * @author bernardo
 *
 */

use Cose\Catalogo\dao\impl\GeneroDoctrineDAO;

use Cose\Catalogo\dao\impl\CondicionIvaDoctrineDAO;

use Cose\Catalogo\dao\impl\EstadoCivilDoctrineDAO;

use Cose\Catalogo\dao\impl\TipoDocumentoDoctrineDAO;

class DAOFactory {
	
	/**
	 * DAO para TipoDocumento.
	 * 
	 * @return ICatalogoDAO
	 */
	public static function getTipoDocumentoDAO(){
	
		return new TipoDocumentoDoctrineDAO();	
	}

	/**
	 * DAO para EstadoCivil.
	 * 
	 * @return ICatalogoDAO
	 */
	public static function getEstadoCivilDAO(){
	
		return new EstadoCivilDoctrineDAO();	
	}
	
	/**
	 * DAO para CondicionIva.
	 * 
	 * @return ICatalogoDAO
	 */
	public static function getCondicionIvaDAO(){
	
		return new CondicionIvaDoctrineDAO();	
	}
		
	/**
	 * DAO para Genero.
	 * 
	 * @return ICatalogoDAO
	 */
	public static function getGeneroDAO(){
	
		return new GeneroDoctrineDAO();	
	}
	
}