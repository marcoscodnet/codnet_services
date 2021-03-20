<?php
namespace Cose\Security\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de userGroup
 *  
 * @author bernardo
 *
 */
class UserGroupCriteria extends Criteria{

	private $name;

	private $nameLike;
	
	private $oidNotEqual;
	
	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}

	public function getNameLike()
	{
	    return $this->nameLike;
	}

	public function setNameLike($nameLike)
	{
	    $this->nameLike = $nameLike;
	}

	public function getOidNotEqual()
	{
	    return $this->oidNotEqual;
	}

	public function setOidNotEqual($oidNotEqual)
	{
	    $this->oidNotEqual = $oidNotEqual;
	}
}
