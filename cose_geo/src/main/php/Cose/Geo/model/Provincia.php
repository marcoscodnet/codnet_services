<?php

namespace Cose\Geo\model;

use Cose\model\impl\Entity;

/**
 * Provincia
 * 
 * @Entity @Table(name="geo_provincia")
 *  
 * @author Bernardo
 * @since 20-08-2015
 */

class Provincia extends Entity{

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
	
	/**
     * @ManyToOne(targetEntity="Pais",cascade={"merge"})
     * @JoinColumn(name="pais_oid", referencedColumnName="oid")
     * @var Pais
     **/
	private $pais;
	
	
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

	public function getPais()
	{
	    return $this->pais;
	}

	public function setPais($pais)
	{
	    $this->pais = $pais;
	}
}
?>