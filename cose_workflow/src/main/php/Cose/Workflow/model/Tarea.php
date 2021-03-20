<?php

namespace Cose\Workflow\model;

use Cose\model\impl\Entity;

/**
 * Tarea
 * 
 * @Entity @Table(name="wkf_tarea")
 *  
 * @author Bernardo
 * @since 01-09-2015
 */

class Tarea extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;

	
	/**
	 * @Column(type="datetime", nullable=true)
	 * @var \DateTime
	 */
	private $fecha;

	/**
	 * @Column(type="datetime", nullable=true)
	 * @var \DateTime
	 */
	private $fechaVencimiento;
	
	/**
	 * @Column(type="datetime", nullable=true)
	 * @var \DateTime
	 */
	private $fechaModificada;
	
	/**
     * usuario supervisor de la tarea
     * 
     * @ManyToOne(targetEntity="Cose\Security\model\User",cascade={"detach"})
     * @JoinColumn(name="supervisor_oid", referencedColumnName="oid")
     **/
	private $supervisor;
	
	/**
     * usuario responsable de ejecutar la tarea
     * 
     * @ManyToOne(targetEntity="Cose\Security\model\User",cascade={"detach"})
     * @JoinColumn(name="responsable_oid", referencedColumnName="oid")
     **/
	private $responsable;
	
	/**
     * rol que deberá tener el usuario que se asigne como
     * responsable de la tarea.
     * 
     * @ManyToOne(targetEntity="Cose\Security\model\UserGroup",cascade={"detach"})
     * @JoinColumn(name="rol_oid", referencedColumnName="oid")
     **/
	private $rol;
	
	/**
	 * 
     * @ManyToOne(targetEntity="Tarea",cascade={"merge"})
     * @JoinColumn(name="padre_oid", referencedColumnName="oid")
     * @var Tarea
     **/
	private $padre;
	
	/**
     * @Column(type="cose_enum")
     * @var TipoTarea
     **/
	private $tipoTarea;
	
	/**
     * @ManyToOne(targetEntity="CategoriaTarea",cascade={"merge"})
     * @JoinColumn(name="categoria_oid", referencedColumnName="oid")
     * @var CategoriaTarea
     **/
	private $categoria;
	
	/**
     * @Column(type="integer")
	 * @var EstadoTarea
     **/
	private $estado;
	
	/**
     * @Column(type="text", nullable=true)
	 * @var string
     **/
	private $observaciones;

	/**
     * @Column(type="float", nullable=true)
	 * @var float
     **/
	private $porcentajeRealizada;
	
	/**
     * @Column(type="integer")
	 * @var PrioridadTarea
     **/
	private $prioridad;
	
	public function __construct(){
		
		$this->setTipoTarea( new TipoTarea() );
		$this->setPrioridad( PrioridadTarea::Normal );
		$this->setEstado( EstadoTarea::Pendiente );
			
	}
	
	public function __toString(){
		 return $this->getNombre() . " / " . $this->getResponsableORol();
	}

	public function getResponsableORol(){
		
		if($this->responsable)
			return $this->responsable;
		else 
			return $this->rol;
		
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getFechaVencimiento()
	{
	    return $this->fechaVencimiento;
	}

	public function setFechaVencimiento($fechaVencimiento)
	{
	    $this->fechaVencimiento = $fechaVencimiento;
	}

	public function getSupervisor()
	{
	    return $this->supervisor;
	}

	public function setSupervisor($supervisor)
	{
	    $this->supervisor = $supervisor;
	}

	public function getResponsable()
	{
	    return $this->responsable;
	}

	public function setResponsable($responsable)
	{
	    $this->responsable = $responsable;
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

	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
	}

	public function getFechaModificada()
	{
	    return $this->fechaModificada;
	}

	public function setFechaModificada($fechaModificada)
	{
	    $this->fechaModificada = $fechaModificada;
	}

	public function getPadre()
	{
	    return $this->padre;
	}

	public function setPadre($padre)
	{
	    $this->padre = $padre;
	}

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
	}

	public function getPorcentajeRealizada()
	{
	    return $this->porcentajeRealizada;
	}

	public function setPorcentajeRealizada($porcentajeRealizada)
	{
	    $this->porcentajeRealizada = $porcentajeRealizada;
	}

	public function getPrioridad()
	{
	    return $this->prioridad;
	}

	public function setPrioridad($prioridad)
	{
	    $this->prioridad = $prioridad;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}
	
	public function getFechaFormateada(){
		
		if(!empty($this->fecha))
			return $this->fecha->format("d/m/Y");
		
	}
	
	public function isPendiente(){
		return $this->getEstado() == EstadoTarea::Pendiente;
	}
	
	public function isFinalizada(){
		return $this->getEstado() == EstadoTarea::Resuelta || $this->getEstado() == EstadoTarea::Cancelada;
	}
	
}
?>