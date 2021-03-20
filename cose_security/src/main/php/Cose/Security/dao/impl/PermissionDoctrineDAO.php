<?php
namespace Cose\Security\dao\impl;

use Cose\Security\model\Permission;

use Cose\Security\dao\IPermissionDAO;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;
use Doctrine\ORM\QueryBuilder;
/**
 * dto para Permission
 *  
 * @author bernardo
 *
 */
class PermissionDoctrineDAO extends CrudDAO implements IPermissionDAO{
	
	protected function getClazz(){
		return get_class( new Permission() );
	}
	
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('p')->from( $this->getClazz() , 'p')
					->leftJoin('p.parent', 'pp');
		
		return $queryBuilder;
	}
	
	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(p.oid)')->from( $this->getClazz() , 'p')
					->leftJoin('p.parent', 'pp');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "p.oid <> :oid");
			$queryBuilder->setParameter( "oid" , $oid );
		}
			
		$name = strtoupper( $criteria->getName() );
		if( !empty($name) ){
			
			$queryBuilder->andWhere("upper(p.name)  like :name");
			$queryBuilder->setParameter( "name" , "%$name%" );
		}
		
		$parent = $criteria->getParent();
		if( !empty($parent) && $parent!=null){
			$parentOid = $parent->getOid();
			if(!empty($parentOid)){
				$queryBuilder->andWhere( "pp.oid= :parentOid");
				$queryBuilder->setParameter( "parentOid" , $parentOid);
			}
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