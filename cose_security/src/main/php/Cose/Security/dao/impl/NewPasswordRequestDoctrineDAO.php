<?php
namespace Cose\Security\dao\impl;

use Cose\Security\model\NewPasswordRequest;

use Cose\Security\dao\INewPasswordRequestDAO;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;
use Doctrine\ORM\QueryBuilder;
/**
 * dto para NewPasswordRequest
 *  
 * @author bernardo
 *
 */
class NewPasswordRequestDoctrineDAO extends CrudDAO implements INewPasswordRequestDAO{
	
	protected function getClazz(){
		return get_class( new NewPasswordRequest() );
	}
	
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('npr','u'))->from( $this->getClazz() , 'npr')
					->leftJoin('npr.user', 'u');
		
		return $queryBuilder;
	}
	
	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(npr.oid)')->from( $this->getClazz() , 'npr')
					->leftJoin('npr.user', 'u');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$validationCode = $criteria->getValidationCode();
		if( !empty($validationCode) ){
			
			//$queryBuilder->where("u.username = '$username'");
			$queryBuilder->where("npr.validationCode = ?1")->setParameter(1, $validationCode);
		}
		
	}
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "npr.$name";	
		}	
		
	}
}