<?php
namespace Cose\Security\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de user
 *  
 * @author bernardo
 *
 */
class UserCriteria extends Criteria{

	private $username;

	private $usernameLike;

	private $oidNotEqual;
	
	private $usergroupNotIn;
	
	private $usergroupIn;
	
	public function getUsername()
	{
	    return $this->username;
	}

	public function setUsername($username)
	{
	    $this->username = $username;
	}

	public function getUsernameLike()
	{
	    return $this->usernameLike;
	}

	public function setUsernameLike($usernameLike)
	{
	    $this->usernameLike = $usernameLike;
	}

	public function getOidNotEqual()
	{
	    return $this->oidNotEqual;
	}

	public function setOidNotEqual($oidNotEqual)
	{
	    $this->oidNotEqual = $oidNotEqual;
	}

	public function getUsergroupNotIn()
	{
	    return $this->usergroupNotIn;
	}

	public function setUsergroupNotIn($usergroupNotIn)
	{
	    $this->usergroupNotIn = $usergroupNotIn;
	}

	public function getUsergroupIn()
	{
	    return $this->usergroupIn;
	}

	public function setUsergroupIn($usergroupIn)
	{
	    $this->usergroupIn = $usergroupIn;
	}
}

