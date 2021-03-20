<?php
namespace Cose\Security\service;

use Cose\Security\service\impl\PermissionServiceImpl;

use Cose\Security\service\impl\UserGroupServiceImpl;

use Cose\Security\service\impl\SecurityServiceImpl;

use Cose\Security\service\impl\UserServiceImpl;


/**
 * Factory de servicios
 *  
 * @author bernardo
 *
 */
class ServiceFactory {
	
	/**
	 * @return IUserService
	 */
	public static function getUserService(){
	
		return new UserServiceImpl();	
	}
	
	
	/**
	 * @return IUserGroupService
	 */
	public static function getUserGroupService(){
	
		return new UserGroupServiceImpl();	
	}
	
	
	/**
	 * @return IPermissionService
	 */
	public static function getPermissionService(){
	
		return new PermissionServiceImpl();	
	}
	
	/**
	 * @return ISecurityService
	 */
	public static function getSecurityService(){
	
		return new SecurityServiceImpl();	
	}
}