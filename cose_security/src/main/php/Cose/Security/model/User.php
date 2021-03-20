<?php
namespace Cose\Security\model;

use Cose\Security\utils\SecurityUtils;

use Cose\Security\model\UserGroup;

use Cose\model\impl\Entity;

/**
 * User
 * @Entity @Table(name="security_user")
 *  
 * @author bernardo
 * 
 */
class User extends Entity{

	/** @Column(type="string") **/
	private $username;
	
	/** @Column(type="string") **/
	private $password;

	/** @Column(type="string") **/
	private $name;
	
	/** @Column(type="string") **/
	private $email;
	
    /**
     * @ManyToMany(targetEntity="UserGroup")
     * @JoinTable(name="security_users_groups",
     *      joinColumns={@JoinColumn(name="user_oid", referencedColumnName="oid")},
     *      inverseJoinColumns={@JoinColumn(name="usergroup_oid", referencedColumnName="oid")}
     *      )
     */
    private $groups;

	/** @Column(type="datetime", nullable=true) **/
	private $lastLogin;
    
	/** @Column(type="string", nullable=true) **/
	private $loginFrom;
    
	/** @Column(type="boolean", nullable=true) **/
	private $logged;


	/** @Column(type="string", nullable=true) **/
	private $lastname;
	
	public function getUsername()
	{
	    return $this->username;
	}

	public function setUsername($username)
	{
	    $this->username = $username;
	}

	public function getPassword()
	{
	    return $this->password;
	}

	public function setPassword($password)
	{
	    $this->password = $password;
	}
	
	public function __toString(){
		return $this->getUsername();
	}
	


	public function getGroups()
	{
	    return $this->groups;
	}

	public function setGroups($groups)
	{
	    $this->groups = $groups;
	}
	
	public function hasUsergroup( UserGroup $group ){
	
		$ok = false;
		
		foreach ($this->getGroups() as $myGroup) {
			$ok = $group->getOid()== $myGroup->getOid();
			if( $ok )
				break;
		}
		
		return $ok;
		
	}

	public function hasUsergroupByName($name){
	
		$ok = false;
		
		foreach ($this->getGroups() as $myGroup) {
			$ok = strtoupper($myGroup->getName()) == strtoupper($name);
			if( $ok )
				break;
		}
		
		return $ok;
		
	}
	
	public function hasPermissionByName($name){
	
		$ok = false;
		
		foreach ($this->getGroups() as $myGroup) {
			$ok = $myGroup->hasPermissionByName($name);
			if( $ok )
				break;
		}
		
		return $ok;
		
	}
	
	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	}

    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    public function getLoginFrom()
    {
        return $this->loginFrom;
    }

    public function setLoginFrom($loginFrom)
    {
        $this->loginFrom = $loginFrom;
    }

    public function getLogged()
    {
        return $this->logged;
    }

    public function setLogged($logged)
    {
        $this->logged = $logged;
    }

	public function getLastname()
	{
	    return $this->lastname;
	}

	public function setLastname($lastname)
	{
	    $this->lastname = $lastname;
	}
	

	protected function doEncrypt(){
	
		\Logger::getLogger(__CLASS__)->info("encrypt: " .$this->getPassword());
		$this->setPassword( SecurityUtils::aesEncrypt($this->getPassword()) );
		\Logger::getLogger(__CLASS__)->info("encrypt: " .$this->getPassword());
	}
	
	protected function doDecrypt(){
		
		$this->setPassword( SecurityUtils::aesDecrypt($this->getPassword()) );
		
	}
	
	
}
