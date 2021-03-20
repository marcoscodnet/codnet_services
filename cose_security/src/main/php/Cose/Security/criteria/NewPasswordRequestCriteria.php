<?php
namespace Cose\Security\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de NewPasswordRequest
 *  
 * @author bernardo
 *
 */
class NewPasswordRequestCriteria extends Criteria{

	private $validationCode;

	public function getValidationCode()
	{
	    return $this->validationCode;
	}

	public function setValidationCode($validationCode)
	{
	    $this->validationCode = $validationCode;
	}
}

