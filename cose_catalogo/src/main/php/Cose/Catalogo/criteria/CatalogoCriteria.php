<?php
namespace Cose\Catalogo\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Catalogo
 *  
 * @author Bernardo
 * @since 30-12-2014
 *
 */
class CatalogoCriteria extends Criteria{

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