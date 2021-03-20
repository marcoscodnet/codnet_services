<?php
namespace Cose\Catalogo\service\impl;


use Cose\Catalogo\service\ICatalogoService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Catalogo
 *  
 * @author Bernardo
 * @since 10-08-2015
 *
 */
abstract class CatalogoServiceImpl extends CrudService implements ICatalogoService{

	
	protected function getNombreRequeridoMsg(){
		return "catalogo.nombre.requerido";
	}
	
	protected function getNombreRepeditoMsg(){
		return "catalogo.nombre.repetido";
	}
	
	
	protected function getCodigoRequeridoMsg(){
		return "catalogo.codigo.requerido";
	}
	
	protected function getCodigoRepetidoMsg(){
		return "catalogo.codigo.repetido";
	}
	
	function validateOnAdd( $entity ){
	
		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException( $this->getNombreRequeridoMsg() );

		//que tenga código
		$codigo = $entity->getCodigo();
		if( empty($codigo) )
			throw new ServiceException( $this->getCodigoRequeridoMsg() );
			
		//TODO unicidad (nombre y codigo)
		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


}