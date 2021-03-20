<?php
namespace Cose\Security\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Permission
 *  
 * @author bernardo
 *
 */
class PermissionCriteria extends Criteria{

	private $name;

	private $oidNotEqual;

	private $parent;
	
	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}


	public function getOidNotEqual()
	{
	    return $this->oidNotEqual;
	}

	public function setOidNotEqual($oidNotEqual)
	{
	    $this->oidNotEqual = $oidNotEqual;
	}

	public function getParent()
	{
	    return $this->parent;
	}

	public function setParent($parent)
	{
	    $this->parent = $parent;
	}
}