<?php
namespace Cose\Geo\service\impl;

use Cose\Geo\service\ILocalidadService;

use Cose\Geo\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Localidad
 *  
 * @author Bernardo
 * @since 20-08-2015
 *
 */
class LocalidadServiceImpl extends CrudService implements ILocalidadService{


	protected function getDAO(){
		return DAOFactory::getLocalidadDAO();
	}
	
	function validateOnAdd( $entity ){
	
		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException( "localidad.nombre.requerido" );

		//que tenga código postal
		$codigoPostal = $entity->getCodigoPostal();
		if( empty($codigoPostal) )
			throw new ServiceException( "localidad.codigoPostal.requerido" );
			

		//que tenga provincia
		$provincia = $entity->getProvincia();
		if( empty($provincia) )
			throw new ServiceException( "localidad.provincia.requerida" );
			
			
		//TODO unicidad (codigo postal)
		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


}