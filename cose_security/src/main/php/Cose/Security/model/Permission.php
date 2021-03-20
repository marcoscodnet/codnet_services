<?php

namespace Cose\Security\model;

use Cose\model\impl\Entity;

/**
 * Permission
 * @Entity @Table(name="security_permission")
 *  
 * @author bernardo
 * 
 */
class Permission extends Entity{

	/** @Column(type="string") **/
	private $name;
	
	/** @Column(type="string",nullable=true) **/
	private $description;
	
	
	/**
     * @ManyToOne(targetEntity="Permission",cascade={"merge"})
     * @JoinColumn(name="parent_oid", referencedColumnName="oid")
     * 
     * @var Permission
     **/
	private $parent;
	
	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}
	
	public function __toString(){
		return $this->getName();
	}
	

	public function getDescription()
	{
	    return $this->description;
	}

	public function setDescription($description)
	{
	    $this->description = $description;
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