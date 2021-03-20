<?php
namespace Cose\Geo\service\impl;

use Cose\Geo\dao\DAOFactory;

use Cose\Geo\service\IProvinciaService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Provincia
 *  
 * @author Bernardo
 * @since 20-08-2015
 *
 */
class ProvinciaServiceImpl extends CrudService implements IProvinciaService{

	protected function getDAO(){
		return DAOFactory::getProvinciaDAO();
	}
	
	function validateOnAdd( $entity ){
	
		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException( "provincia.nombre.requerido" );

		//que tenga código
		$codigo = $entity->getCodigo();
		if( empty($codigo) )
			throw new ServiceException( "provincia.codigo.requerido" );
			

		//que tenga pais
		$pais = $entity->getPais();
		if( empty($pais) )
			throw new ServiceException( "provincia.pais.requerido" );
			
			
		//TODO unicidad (nombre y codigo)
		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


}