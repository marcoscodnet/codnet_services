<?php
namespace Cose\Workflow\service\impl;

use Cose\Workflow\model\TipoTarea;

use Cose\Workflow\model\PrioridadTarea;

use Cose\Workflow\model\EstadoTarea;

use Cose\Workflow\dao\DAOFactory;

use Cose\Workflow\service\ITareaService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Tarea
 *  
 * @author Bernardo
 * @since 01-09-2015
 *
 */
class TareaServiceImpl extends CrudService implements ITareaService{

	protected function getDAO(){
		return DAOFactory::getTareaDAO();
	}

	public function add($entity){
		
		$entity->setFechaModificada( new \DateTime() );
		
		$estado = $entity->getEstado();
		if( empty( $estado ) )
			$entity->setEstado( EstadoTarea::Pendiente  );
		
		$prioridad = $entity->getPrioridad();
		if( empty( $prioridad ) )
			$entity->setPrioridad( PrioridadTarea::Normal );

		$tipoTarea = $entity->getTipoTarea();
		if( empty( $tipoTarea ) )
			$entity->setTipoTarea( new TipoTarea() );

		$nombre = $entity->getNombre();
		if( empty( $nombre ) )
			$entity->setNombre( $tipoTarea->getNombre() );
			
		parent::add($entity);
		
	}

	public function udpate($entity){
		
		$entity->setFechaModificada( new \DateTime() );
		
		parent::update($entity);
		
	}
	
	function validateOnAdd( $entity ){
	
		//que tenga tipo tarea
		$tipo = $entity->getTipoTarea();
		if( empty($tipo) )
			throw new ServiceException( "tarea.tipoTarea.requerida" );

		//que tenga categoria
		$categoria = $entity->getCategoria();
		if( empty($categoria) )
			throw new ServiceException( "tarea.categoria.requerida" );

		//que tenga estado
		$estado = $entity->getEstado();
		if( empty($estado) )
			throw new ServiceException( "tarea.estado.requerido" );
			
		//que tenga rol o responsable
		$rol = $entity->getRol();
		$responsable = $entity->getResponsable();
		if( empty($rol) && empty($responsable))
			throw new ServiceException( "tarea.responsable_rol.requerido" );
			
			
		//TODO unicidad??
		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


}