<?php
namespace Cose\Geo\service\impl;

use Cose\Geo\dao\DAOFactory;

use Cose\Geo\service\IPaisService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Pais
 *  
 * @author Bernardo
 * @since 20-08-2015
 *
 */
class PaisServiceImpl extends CrudService implements IPaisService{


	protected function getDAO(){
		return DAOFactory::getPaisDAO();
	}
	
	
	function validateOnAdd( $entity ){
	
		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException( "pais.nombre.requerido" );

		//que tenga código
		$codigo = $entity->getCodigo();
		if( empty($codigo) )
			throw new ServiceException( "pais.codigo.requerido" );
			
		//TODO unicidad (nombre y codigo)
		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


}