<?php

namespace Cose\Catalogo\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

/**
 * Catalogo
 * 
 * @MappedSuperclass
 
 * @author Bernardo
 * @since 10-08-2015
 */

abstract class Catalogo extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;

		
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $descripcion;
	
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

	public function getDescripcion()
	{
	    return $this->descripcion;
	}

	public function setDescripcion($descripcion)
	{
	    $this->descripcion = $descripcion;
	}
}
?>