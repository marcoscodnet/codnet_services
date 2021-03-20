<?php
namespace Cose\Security\service\impl;

use Cose\Security\exception\PermissionNotFoundException;

use Cose\Security\criteria\PermissionCriteria;

use Cose\Security\dao\DAOFactory, 
	Cose\Security\service\IPermissionService;

use Cose\Crud\service\impl\CrudService;
use Cose\exception\DAOException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceException;

/**
 * servicio para Permission
 *  
 * @author bernardo
 *
 */
class PermissionServiceImpl extends CrudService implements IPermissionService {
	
	protected function getDAO(){
		return DAOFactory::getPermissionDAO();
	}
	
	function validateOnAdd( $entity ){
	
		//que no exista otro con mismo name.
		$name = $entity->getName();
		$criteria = new PermissionCriteria();
		$criteria->setName($name);
		$criteria->setOidNotEqual($entity->getOid());
		$count = $this->getCount($criteria);
		
		if( $count > 0){
			throw new ServiceException( "permission.add.name.repetead" );
		}
		
		
	}
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Cose/Security/service/Cose\Security\service.IPermissionService::getPermissionByName()
	 */
	function getPermissionByName($name){
	
		try{
			
			if(empty($name))
				throw new PermissionNotFoundException( "notfound" );
			
			$criteria = new PermissionCriteria();
			$criteria->setName($name);
		
			$userGroup = $this->getSingleResult( $criteria );
	
			return $userGroup;

			
		
		} catch (ServiceNoResultException $e) {

			throw new PermissionNotFoundException( $e->getMessage() );
			
		} catch (\Exception $e) {
				
			throw new ServiceException( $e->getMessage() );
		}
		
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Cose/Security/service/Cose\Security\service.IPermissionService::getPermissionBranchByName()
	 */
	function getPermissionBranchByName( $name ){
	
		$branch = array();
	
		$permission = $this->getPermissionByName($name);
		$branch[] = $permission;
		
		while ( $permission->getParent()!=null ){
			$parent = $permission->getParent();
		
			$permission = $this->getPermissionByName($parent->getName());
			$branch[] = $permission;	
		}
		
		return $branch;
	}
	
}