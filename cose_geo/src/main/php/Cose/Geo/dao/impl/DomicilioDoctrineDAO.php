<?php
namespace Cose\Geo\dao\impl;

use Cose\Geo\model\Domicilio;

use Cose\Geo\dao\IDomicilioDAO;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Domicilio
 *  
 * @author Bernardo
 * @since 20-08-2015
 * 
 */
class DomicilioDoctrineDAO extends CrudDAO implements IDomicilioDAO{
	

	protected function getClazz(){
		return get_class( new Domicilio() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('d'))
	   				->from( $this->getClazz(), "d")
	   				->leftJoin('d.localidad', 'l');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(d.oid)')
	   				->from( $this->getClazz(), "d")
	   				->leftJoin('d.localidad', 'l');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "d.oid <> $oid");
		}
		
		$localidad = $criteria->getLocalidad();
		if( $localidad != null ){
			$localidadOid = $localidad->getOid();
			$queryBuilder->andWhere( "l.oid = $localidadOid");
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "d.$name";	
		}	
		
	}	
}