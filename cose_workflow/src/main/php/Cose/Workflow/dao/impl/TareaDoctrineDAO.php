<?php
namespace Cose\Workflow\dao\impl;


use Cose\Workflow\model\Tarea;

use Cose\Workflow\dao\ITareaDAO;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Tarea
 *  
 * @author Bernardo
 * @since 01-09-2015
 * 
 */
class TareaDoctrineDAO extends CrudDAO implements ITareaDAO{
	

	protected function getClazz(){
		return get_class( new Tarea() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('t'))
	   				->from( $this->getClazz(), "t")
	   				->leftJoin('t.responsable', 'res')
	   				->leftJoin('t.rol', 'r')
	   				->leftJoin('t.categoria', 'cat')
	   				->leftJoin('t.padre', 'p');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(t.oid)')
	   				->from( $this->getClazz(), "t")
	   				->leftJoin('t.responsable', 'res')
	   				->leftJoin('t.rol', 'r')
	   				->leftJoin('t.categoria', 'cat')
	   				->leftJoin('t.padre', 'p');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "t.oid <> :oid");
			$queryBuilder->setParameter( "oid" , $oid );
		}
		
		$texto = $criteria->getTexto();
		if( !empty($texto) ){
			$queryBuilder->andWhere( 
			
					$queryBuilder->expr()->orX(
		       			$queryBuilder->expr()->like('t.nombre', ':t1'),
		       			$queryBuilder->expr()->orX(
		       				$queryBuilder->expr()->like('res.username', ':t1'),
		       				$queryBuilder->expr()->like('r.name', ':t1')
		   				)
		   			)
			
			);
			$queryBuilder->setParameter( "t1" , "%$texto%" );
			//$queryBuilder->setParameter( "t2" , "%$texto%" );
		}
	
		$responsable = $criteria->getResponsable();
		if( !empty($responsable) ){
			$responsableOid = $responsable->getOid();
			$queryBuilder->andWhere( "res.oid = $responsableOid");
		}
	
		$rol = $criteria->getRol();
		if( !empty($rol) ){
			$rolOid = $rol->getOid();
			$queryBuilder->andWhere( "r.oid = $rolOid");
		}
		
		$padre = $criteria->getPadre();
		if( !empty($padre) ){
			$padreOid = $padre->getOid();
			$queryBuilder->andWhere( "p.oid = $padreOid");
		}
		
		$padreIsNull = $criteria->getPadreIsNull();
		if( $padreIsNull ){
			$queryBuilder->andWhere( "p is null");
		}

		
		$categoria = $criteria->getCategoria();
		if( !empty($categoria) ){
			$categoriaOid = $categoria->getOid();
			$queryBuilder->andWhere( "cat.oid = $categoriaOid");
		}
	
		$tipo = $criteria->getTipoTarea();
		if( !empty($tipo) ){
			$queryBuilder->andWhere( "t.tipoTarea = :tipo");
			$queryBuilder->setParameter( "tipo", $tipo, "cose_enum");
		}
		
		$estadosNotIn = $criteria->getEstadosNotIn();
		if( !empty($estadosNotIn)){
			
			$oids = implode(",", $estadosNotIn);
			
			$queryBuilder->andWhere("t.estado not in ($oids)");
		}

		$estadosIn = $criteria->getEstadosIn();
		if( !empty($estadosIn)){
			
			$oids = implode(",", $estadosIn);
			
			$queryBuilder->andWhere("t.estado in ($oids)");
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "t.$name";	
		}	
		
	}	
}