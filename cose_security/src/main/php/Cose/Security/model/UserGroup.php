<?php

namespace Cose\Security\model;

use Cose\model\impl\Entity;

/**
 * UserGroup
 * @Entity @Table(name="security_usergroup")
 *  
 * @author bernardo
 * 
 */
class UserGroup extends Entity{

	/** @Column(type="string") **/
	private $name;

	/** @Column(type="string",nullable=true) **/
	private $description;
	
	/** @Column(type="integer") **/
	private $level;
	
	/**
     * @ManyToMany(targetEntity="Permission")
     * @JoinTable(name="security_groups_permissions",
     *      joinColumns={@JoinColumn(name="usergroup_oid", referencedColumnName="oid")},
     *      inverseJoinColumns={@JoinColumn(name="permission_oid", referencedColumnName="oid")}
     *      )
     */
    private $permissions;
	

	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}

	public function getLevel()
	{
	    return $this->level;
	}

	public function setLevel($level)
	{
	    $this->level = $level;
	}

	
	public function __toString(){
		return $this->getName();
	}
	

	public function getPermissions()
	{
	    return $this->permissions;
	}

	public function setPermissions($permissions)
	{
	    $this->permissions = $permissions;
	}
	
	public function hasPermissionByName($name){
	
		//buscamos el permiso por nombre
		
		$ok = false;
		
		foreach ($this->getPermissions() as $myPermission) {
			$ok = strtoupper($myPermission->getName()) == strtoupper($name);
			if( $ok )
				break;
		}
		
		return $ok;
		
	}

	public function getDescription()
	{
	    return $this->description;
	}

	public function setDescription($description)
	{
	    $this->description = $description;
	}
}
