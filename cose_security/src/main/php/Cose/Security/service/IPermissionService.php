<?php
namespace Cose\Security\service;

use Cose\Crud\service\ICrudService;

/**
 * interfaz para el servicio de Permission
 *  
 * @author bernardo
 *
 */
interface IPermissionService extends ICrudService {
	
	/**
	 * Recupera un Permission dado el name
	 * @param $name
	 * 
	 * @throws ServiceException
	 */
	function getPermissionByName($name);
	
	/**
	 * Recupera toda la rama (hacia arriba) del pesrmission dado el name
	 * @param $name
	 */
	function getPermissionBranchByName($name);
	
	
}