<?php
namespace Cose\Catalogo\dao\impl;


use Cose\Catalogo\dao\ICatalogoDAO;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Catalogo
 *  
 * @author Bernardo
 * @since 10-08-2015
 * 
 */
abstract class CatalogoDoctrineDAO extends CrudDAO implements ICatalogoDAO{
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('c'))
	   				->from( $this->getClazz(), "c");
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(c.oid)')
	   				->from( $this->getClazz(), "c");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "c.oid <> :oid");
			$queryBuilder->setParameter( "oid" , $oid );
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "c.nombre like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}

		$codigo = $criteria->getCodigo();
		if( !empty($codigo) ){
			$queryBuilder->andWhere( "c.codigo = :codigo");
			$queryBuilder->setParameter( "codigo" , $codigo );
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "c.$name";	
		}	
		
	}	
}