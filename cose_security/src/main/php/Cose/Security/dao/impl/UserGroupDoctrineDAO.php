<?php
namespace Cose\Security\dao\impl;

use Cose\Security\model\User;
use Cose\Security\model\UserGroup;

use Cose\Security\dao\IUserGroupDAO;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;
use Doctrine\ORM\QueryBuilder;
/**
 * dto para userGroup
 *  
 * @author bernardo
 *
 */
class UserGroupDoctrineDAO extends CrudDAO implements IUserGroupDAO{
	
	protected function getClazz(){
		return get_class( new UserGroup() );
	}
	
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('ug')->from( $this->getClazz() , 'ug');
		
		return $queryBuilder;
	}
	
	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(ug.oid)')->from( $this->getClazz() , 'ug');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	

		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "ug.oid <> :oid");
			$queryBuilder->setParameter( "oid" , $oid );
		}
			
		$name = $criteria->getName();
		if( !empty($name) ){
			$queryBuilder->andWhere("ug.name = :name")->setParameter("name", $name);
		}
		
		$nameLike = $criteria->getNameLike();
		if( !empty($nameLike) ){
			$queryBuilder->andWhere("ug.name like :nameLike");
			$queryBuilder->setParameter( "nameLike" , "%$nameLike%" );
		}
		
	}
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "ug.$name";	
		}	
		
	}
}