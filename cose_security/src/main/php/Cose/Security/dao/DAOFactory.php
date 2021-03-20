<?php
namespace Cose\Security\dao;

use Cose\Security\dao\impl\NewPasswordRequestDoctrineDAO;

use Cose\Security\dao\impl\PermissionDoctrineDAO;

use Cose\Security\dao\impl\UserGroupDoctrineDAO;

use Cose\Security\dao\impl\UserDoctrineDAO;



/**
 * Factory de DAOs
 *  
 * @author bernardo
 *
 */
class DAOFactory {
	
	/**
	 * DAO para NewPasswordRequest.
	 * 
	 * @return INewPasswordRequestDAO
	 */
	public static function getNewPasswordRequestDAO(){
	
		return new NewPasswordRequestDoctrineDAO();	
	}
	
	/**
	 * DAO para User.
	 * 
	 * @return IUserDAO
	 */
	public static function getUserDAO(){
	
		return new UserDoctrineDAO();	
	}
	
	/**
	 * DAO para UserGroup.
	 * 
	 * @return IUserGroupDAO
	 */
	public static function getUserGroupDAO(){
	
		return new UserGroupDoctrineDAO();	
	}
	
	/**
	 * DAO para Permission.
	 * 
	 * @return IPermissionDAO
	 */
	public static function getPermissionDAO(){
	
		return new PermissionDoctrineDAO();	
	}
}