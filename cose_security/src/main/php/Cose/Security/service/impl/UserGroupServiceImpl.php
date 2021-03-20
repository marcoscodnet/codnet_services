<?php
namespace Cose\Security\service\impl;

use Cose\Security\exception\UserGroupNotFoundException;

use Cose\Security\criteria\UserGroupCriteria;

use Cose\Security\dao\DAOFactory, 
	Cose\Security\service\IUserGroupService;

use Cose\Crud\service\impl\CrudService;
use Cose\exception\DAOException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceException;

/**
 * servicio para userGroup
 *  
 * @author bernardo
 *
 */
class UserGroupServiceImpl extends CrudService implements IUserGroupService {
	
	protected function getDAO(){
		return DAOFactory::getUserGroupDAO();
	}
	
	function validateOnAdd( $entity ){
		
		//que no exista otro usergroup con mismo name.
		$name = $entity->getName();
		$criteria = new UserGroupCriteria();
		$criteria->setName($name);
		$criteria->setOidNotEqual($entity->getOid());
		$count = $this->getCount($criteria);
		
		if( $count > 0){
			throw new ServiceException( "usergroup.add.name.repetead" );
		}
		
	
	}
	
	function validateOnUpdate( $entity ){
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Cose/Security/service/Cose\Security\service.IUserGroupService::getUserGroupByName()
	 */
	function getUserGroupByName($name){
	
		try{
			
			if(empty($name))
				throw new UserGroupNotFoundException( $e->getMessage() );
			
			$criteria = new UserGroupCriteria();
			$criteria->setName($name);
		
			$userGroup = $this->getSingleResult( $criteria );
	
			return $userGroup;

			
		
		} catch (ServiceNoResultException $e) {

			throw new UserGroupNotFoundException( $e->getMessage() );
			
		} catch (\Exception $e) {
				
			throw new ServiceException( $e->getMessage() );
		}
		
	}	
}