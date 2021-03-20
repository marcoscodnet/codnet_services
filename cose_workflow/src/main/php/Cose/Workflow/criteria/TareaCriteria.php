<?php
namespace Cose\Workflow\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Tarea
 *  
 * @author Bernardo
 * @since 01-09-2015
 *
 */
class TareaCriteria extends Criteria{

	private $oidNotEqual;
	
	private $responsable;
	
	private $supervisor;
	
	private $rol;
	
	private $tipoTarea;
	
	private $categoria;
	
	private $estadosIn;

	private $estadosNotIn;

	private $texto;

	private $fechaDesde;
	
	private $fechaHasta;

	private $padre;
	
	private $padreIsNull;
	
	public function getOidNotEqual()
	{
	    return $this->oidNotEqual;
	}

	public function setOidNotEqual($oidNotEqual)
	{
	    $this->oidNotEqual = $oidNotEqual;
	}

	public function getRol()
	{
	    return $this->rol;
	}

	public function setRol($rol)
	{
	    $this->rol = $rol;
	}

	public function getTipoTarea()
	{
	    return $this->tipoTarea;
	}

	public function setTipoTarea($tipoTarea)
	{
	    $this->tipoTarea = $tipoTarea;
	}

	public function getCategoria()
	{
	    return $this->categoria;
	}

	public function setCategoria($categoria)
	{
	    $this->categoria = $categoria;
	}

	public function getEstadosIn()
	{
	    return $this->estadosIn;
	}

	public function setEstadosIn($estadosIn)
	{
	    $this->estadosIn = $estadosIn;
	}

	public function getEstadosNotIn()
	{
	    return $this->estadosNotIn;
	}

	public function setEstadosNotIn($estadosNotIn)
	{
	    $this->estadosNotIn = $estadosNotIn;
	}

	public function getResponsable()
	{
	    return $this->responsable;
	}

	public function setResponsable($responsable)
	{
	    $this->responsable = $responsable;
	}

	public function getTexto()
	{
	    return $this->texto;
	}

	public function setTexto($texto)
	{
	    $this->texto = $texto;
	}

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getPadre()
	{
	    return $this->padre;
	}

	public function setPadre($padre)
	{
	    $this->padre = $padre;
	}

	public function getPadreIsNull()
	{
	    return $this->padreIsNull;
	}

	public function setPadreIsNull($padreIsNull)
	{
	    $this->padreIsNull = $padreIsNull;
	}

	public function getSupervisor()
	{
	    return $this->supervisor;
	}

	public function setSupervisor($supervisor)
	{
	    $this->supervisor = $supervisor;
	}
}