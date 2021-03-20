<?php

namespace Cose\Geo\model;

use Cose\model\impl\Entity;

/**
 * Pais
 * 
 * @Entity @Table(name="geo_pais")
 *  
 * @author Bernardo
 * @since 20-08-2015
 */

class Pais extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $codigo;
	
	
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

	public function getCodigo()
	{
	    return $this->codigo;
	}

	public function setCodigo($codigo)
	{
	    $this->codigo = $codigo;
	}
}
?>