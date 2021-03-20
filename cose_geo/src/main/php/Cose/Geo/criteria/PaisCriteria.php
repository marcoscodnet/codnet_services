<?php
namespace Cose\Geo\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Pais
 *  
 * @author Bernardo
 * @since 20-08-2015
 *
 */
class PaisCriteria extends Criteria{

	private $oidNotEqual;
	
	private $nombre;
	
	private $codigo;
	

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

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

}