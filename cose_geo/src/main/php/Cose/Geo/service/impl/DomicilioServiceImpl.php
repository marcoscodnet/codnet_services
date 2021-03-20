<?php
namespace Cose\Geo\service\impl;

use Cose\Geo\service\IDomicilioService;

use Cose\Geo\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Domicilio
 *  
 * @author Bernardo
 * @since 20-08-2015
 *
 */
class DomicilioServiceImpl extends CrudService implements IDomicilioService{


	protected function getDAO(){
		return DAOFactory::getDomicilioDAO();
	}
	
	function validateOnAdd( $entity ){
	
		//que tenga calle
		$calle = $entity->getCalle();
		if( empty($calle) )
			throw new ServiceException( "domicilio.calle.requerida" );

		//que tenga localidad
		$localidad = $entity->getLocalidad();
		if( empty($localidad) )
			throw new ServiceException( "domicilio.localidad.requerida" );
			
			
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


}