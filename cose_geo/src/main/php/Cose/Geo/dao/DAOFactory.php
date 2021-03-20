<?php
namespace Cose\Geo\dao;


/**
 * Factory de DAOs
 *  
 * @author bernardo
 *
 */
use Cose\Geo\dao\impl\DomicilioDoctrineDAO;

use Cose\Geo\dao\impl\LocalidadDoctrineDAO;

use Cose\Geo\dao\impl\ProvinciaDoctrineDAO;

use Cose\Geo\dao\impl\PaisDoctrineDAO;

class DAOFactory {
	
	/**
	 * DAO para Pais.
	 * 
	 * @return IPaisDAO
	 */
	public static function getPaisDAO(){
	
		return new PaisDoctrineDAO();	
	}
	
	/**
	 * DAO para Provincia.
	 * 
	 * @return IProvinciaDAO
	 */
	public static function getProvinciaDAO(){
	
		return new ProvinciaDoctrineDAO();	
	}
	
	/**
	 * DAO para Localidad.
	 * 
	 * @return ILocalidadDAO
	 */
	public static function getLocalidadDAO(){
	
		return new LocalidadDoctrineDAO();	
	}
	
	/**
	 * DAO para Domicilio.
	 * 
	 * @return IDomicilioDAO
	 */
	public static function getDomicilioDAO(){
	
		return new DomicilioDoctrineDAO();	
	}
	
	
	
}