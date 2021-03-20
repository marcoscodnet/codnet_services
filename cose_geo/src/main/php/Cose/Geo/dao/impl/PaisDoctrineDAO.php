<?php
namespace Cose\Geo\dao\impl;

use Cose\Geo\dao\IPaisDAO;

use Cose\Geo\model\Pais;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Pais
 *  
 * @author Bernardo
 * @since 20-08-2015
 * 
 */
class PaisDoctrineDAO extends CrudDAO implements IPaisDAO{
	

	protected function getClazz(){
		return get_class( new Pais() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('p'))
	   				->from( $this->getClazz(), "p");
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(p.oid)')
	   				->from( $this->getClazz(), "p");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "p.oid <> $oid");
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "p.nombre like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}

		$codigo = $criteria->getCodigo();
		if( !empty($codigo) ){
			$queryBuilder->andWhere( "p.codigo = :codigo");
			$queryBuilder->setParameter( "codigo" , $codigo );
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "p.$name";	
		}	
		
	}	
}