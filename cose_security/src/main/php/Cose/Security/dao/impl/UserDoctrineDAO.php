<?php
namespace Cose\Security\dao\impl;

use Cose\Security\model\User;

use Cose\Security\dao\IUserDAO;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;
use Doctrine\ORM\QueryBuilder;
/**
 * dto para user
 *  
 * @author bernardo
 *
 */
class UserDoctrineDAO extends CrudDAO implements IUserDAO{
	
	protected function getClazz(){
		return get_class( new User() );
	}
	
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('u')->from( $this->getClazz() , 'u')
					->leftJoin('u.groups', 'ug');
		
		return $queryBuilder;
	}
	
	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(u.oid)')->from( $this->getClazz() , 'u')
					->leftJoin('u.groups', 'ug');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	

		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "u.oid <> :oid");
			$queryBuilder->setParameter( "oid" , $oid );
		}
			
		$username = $criteria->getUsername();
		if( !empty($username) ){
			
			//$queryBuilder->where("u.username = '$username'");
			$queryBuilder->andWhere("u.username = :username")->setParameter("username", $username);
		}
		
		$usernameLike = $criteria->getUsernameLike();
		if( !empty($usernameLike) ){
			
			//$queryBuilder->where("u.username = '$username'");
			$queryBuilder->andWhere("u.username like :usernameLike");
			$queryBuilder->setParameter( "usernameLike" , "%$usernameLike%" );
		}

		$usergroupNotIn = $criteria->getUsergroupNotIn();
		if( !empty($usergroupNotIn)){
			
			$oids = implode(",", $usergroupNotIn);
			
			//$queryBuilder->where("u.username = '$username'");
			$queryBuilder->andWhere("ug.oid not in ($oids)");
			$queryBuilder->orWhere("ug.oid is null");
		}
		
		$usergroupIn = $criteria->getUsergroupIn();
		if( !empty($usergroupIn)){
			
			$oids = implode(",", $usergroupIn);
			
			//$queryBuilder->where("u.username = '$username'");
			$queryBuilder->andWhere("ug.oid in ($oids)");
			
		}
		
	}
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "u.$name";	
		}	
		
	}
}