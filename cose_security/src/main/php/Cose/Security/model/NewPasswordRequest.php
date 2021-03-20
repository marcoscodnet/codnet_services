<?php
namespace Cose\Security\model;

use Cose\Security\model\UserGroup;

use Cose\model\impl\Entity;

/**
 * NewPasswordRequest
 * @Entity @Table(name="security_new_password_request")
 *  
 * @author bernardo
 * 
 */
class NewPasswordRequest extends Entity{

	
	/**
     * @ManyToOne(targetEntity="User",cascade={"merge"})
     * @JoinColumn(name="user_oid", referencedColumnName="oid")
     * 
     * usuario que realizó la solicitud
     **/
	private $user;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $validationCode;
	
	/** 
	 * @Column(type="date")
	 *  
	 **/
	private $expirationDate;

	public function getUser()
	{
	    return $this->user;
	}

	public function setUser($user)
	{
	    $this->user = $user;
	}

	public function getValidationCode()
	{
	    return $this->validationCode;
	}

	public function setValidationCode($validationCode)
	{
	    $this->validationCode = $validationCode;
	}

	public function getExpirationDate()
	{
	    return $this->expirationDate;
	}

	public function setExpirationDate($expirationDate)
	{
	    $this->expirationDate = $expirationDate;
	}
}
