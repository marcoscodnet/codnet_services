<?php
namespace Cose\Geo\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Domicilio
 *  
 * @author Bernardo
 * @since 20-08-2015
 *
 */
class DomicilioCriteria extends Criteria{

	private $oidNotEqual;
	
	private $localidad;
	
	
    public function getOidNotEqual()
    {
        return $this->oidNotEqual;
    }

    public function setOidNotEqual($oidNotEqual)
    {
        $this->oidNotEqual = $oidNotEqual;
    }


	public function getLocalidad()
	{
	    return $this->localidad;
	}

	public function setLocalidad($localidad)
	{
	    $this->localidad = $localidad;
	}
}