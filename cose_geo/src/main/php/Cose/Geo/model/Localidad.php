<?php

namespace Cose\Geo\model;

use Cose\model\impl\Entity;

/**
 * Localidad
 * 
 * @Entity @Table(name="geo_localidad")
 *  
 * @author Bernardo
 * @since 20-08-2015
 */

class Localidad extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;
	
	/**
     * @ManyToOne(targetEntity="Provincia",cascade={"merge"})
     * @JoinColumn(name="provincia_oid", referencedColumnName="oid")
     * @var Provincia
     **/
	private $provincia;

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $codigoPostal;
	
	
	public function __construct(){
		
	}
	
	public function __toString(){
		 return $this->getNombre();
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
?>