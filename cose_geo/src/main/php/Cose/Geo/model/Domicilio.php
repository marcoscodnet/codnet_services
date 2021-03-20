<?php

namespace Cose\Geo\model;

use Cose\model\impl\Entity;

/**
 * Domicilio
 * 
 * @Entity @Table(name="geo_domicilio")
 *  
 * @author Bernardo
 * @since 20-08-2015
 */

class Domicilio extends Entity{

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $calle;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $numero;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $depto;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $piso;
	
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $codigoPostal;
	
	
	/**
     * @ManyToOne(targetEntity="Localidad",cascade={"merge"})
     * @JoinColumn(name="localidad_oid", referencedColumnName="oid")
     * @var Localidad
     **/
	private $localidad;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $entreCalle1;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $entreCalle2;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $barrio;
	
	
	public function __construct(){
		
	}
	
	public function __toString(){
		 return $this->getCalle() . " " . $this->getNumero(). " " . $this->getPiso(). " " . $this->getDepto();
	}
	

	public function getCalle()
	{
	    return $this->calle;
	}

	public function setCalle($calle)
	{
	    $this->calle = $calle;
	}

	public function getNumero()
	{
	    return $this->numero;
	}

	public function setNumero($numero)
	{
	    $this->numero = $numero;
	}

	public function getDepto()
	{
	    return $this->depto;
	}

	public function setDepto($depto)
	{
	    $this->depto = $depto;
	}

	public function getPiso()
	{
	    return $this->piso;
	}

	public function setPiso($piso)
	{
	    $this->piso = $piso;
	}

	public function getCodigoPostal()
	{
	    return $this->codigoPostal;
	}

	public function setCodigoPostal($codigoPostal)
	{
	    $this->codigoPostal = $codigoPostal;
	}

	public function getLocalidad()
	{
	    return $this->localidad;
	}

	public function setLocalidad($localidad)
	{
	    $this->localidad = $localidad;
	}

	public function getEntreCalle1()
	{
	    return $this->entreCalle1;
	}

	public function setEntreCalle1($entreCalle1)
	{
	    $this->entreCalle1 = $entreCalle1;
	}

	public function getEntreCalle2()
	{
	    return $this->entreCalle2;
	}

	public function setEntreCalle2($entreCalle2)
	{
	    $this->entreCalle2 = $entreCalle2;
	}

	public function getBarrio()
	{
	    return $this->barrio;
	}

	public function setBarrio($barrio)
	{
	    $this->barrio = $barrio;
	}
}
?>