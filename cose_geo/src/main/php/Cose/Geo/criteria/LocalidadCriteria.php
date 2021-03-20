<?php
namespace Cose\Geo\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Localidad
 *  
 * @author Bernardo
 * @since 20-08-2015
 *
 */
class LocalidadCriteria extends Criteria{

	private $oidNotEqual;
	
	private $nombre;
	
	private $codigoPostal;
	
	private $provincia;
	
	
    public function getOidNotEqual()
    {
        return $this->oidNotEqual;
    }

    public function setOidNotEqual($oidNotEqual)
    {
        $this->oidNotEqual = $oidNotEqual;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

 	public function getProvincia()
	{
	    return $this->provincia;
	}

	public function setProvincia($provincia)
	{
	    $this->provincia = $provincia;
	}

	public function getCodigoPostal()
	{
	    return $this->codigoPostal;
	}

	public function setCodigoPostal($codigoPostal)
	{
	    $this->codigoPostal = $codigoPostal;
	}
}