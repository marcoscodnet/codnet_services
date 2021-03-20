<?php

namespace Cose\model\impl;

use Cose\model\IEntity;

//use DoctrineExtensions\Versionable\Versionable;

/**
 * entity genérica
 *  
 * @author bernardo
 * 
 * @MappedSuperclass 
 */
abstract class Entity implements IEntity{//, Versionable {

	/** @Id @Column(type="integer") @GeneratedValue **/
	private $oid;
	
	/*
	 * @Column(type="integer")
	 *  
	 **/
	private $version;
	

	private $encrypted=true;

	/*
	public function equals($obj) {
		if (obj == null) {
			return false;
		}

		if (!$obj->getClass()->equals($this->getClass()))
			return false;

		$ok = $this->getOid() == $obj->getOid();
		return ok;
		
	}*/

	/**
	 * @return the oid
	 */
	public function getOid() {
		return $this->oid;
	}

	/**
	 * @param oid the oid to set
	 */
	public function setOid($oid) {
		$this->oid = $oid;
	}

	/**
	 * @return the version
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * @param version the version to set
	 */
	public function setVersion($version) {
		$this->version = $version;
	}
	
	public function __toString(){
		return $this->getOid() . " - v" . $this->getVersion();
	}

	public function getEncrypted()
	{
	    return $this->encrypted;
	}

	public function setEncrypted($encrypted)
	{
	    $this->encrypted = $encrypted;
	}
	
 
	protected function doEncrypt(){}
	
	protected function doDecrypt(){}

	public function encrypt(){
		
    	if($this->encrypted)
			return ;
		
		$this->doEncrypt();

//		$entities = $this->getManagedEntities();
//		foreach ($entities as $managed) {
//			if($managed!=null)
//				$managed->encrypt();
//		}
			
			
		$this->setEncrypted(true);
	}
	
	public function decrypt(){
		
		if(!$this->encrypted)
			return ;
			
		$this->doDecrypt();

//		$entities = $this->getManagedEntities();
//		foreach ($entities as $managed) {
//			if($managed!=null)
//				$managed->decrypt();
//		}
		
		$this->setEncrypted(false);
	}
	
	
	public function getManagedEntities(){
	
		$entities = array();
		
		$user = null;
		if( method_exists($this, 'getUser') ){
			$user = $this->getUser();
		}
		
		if( method_exists($this, 'getUsuario') ){
			$user = $this->getUsuario();
		}
		
		if($user!=null)
			$entities[] = $user;
		return $entities;
	}
	
	
}