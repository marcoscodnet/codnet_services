<?php
namespace Cose\Security\service;

use Cose\Crud\service\ICrudService;

/**
 * interfaz para el servicio de userGroup
 *  
 * @author bernardo
 *
 */
interface IUserGroupService extends ICrudService {
	
	/**
	 * Recupera un userGroup dado el name
	 * @param $name
	 * 
	 * @throws ServiceException
	 */
	function getUserGroupByName($name);
	
	
}