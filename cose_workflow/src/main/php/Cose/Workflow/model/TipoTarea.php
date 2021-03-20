<?php

namespace Cose\Workflow\model;

use Cose\model\impl\Entity;

/**
 * Tarea
 * 
 * @author Bernardo
 * @since 01-09-2015
 */

class TipoTarea {

	//variables de instancia.
	
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getNombre();
	}

	/**
	 * se inicia la tarea.
	 * @param Tarea $tarea
	 */
	public function iniciarTarea( Tarea $tarea ){
		
		$tarea->setEstado( EstadoTarea::EnProceso );
		
	}

	/**
	 * se realiza la tarea
	 * @param Tarea $tarea
	 */
	public function hacerTarea( Tarea $tarea ){
		
		$tarea->setEstado( EstadoTarea::Resuelta );
		
	}

	/**
	 * se cancela la tarea
	 * @param Tarea $tarea
	 */
	public function cancelarTarea( Tarea $tarea ){
		
		$tarea->setEstado( EstadoTarea::Cancelada );
		
	}

	/**
	 * nombre del tipo de tarea
	 * @return string
	 */
	public function getNombre(){
		return "tipoTarea.general.nombre";
	}


	/**
	 * descripción del tipo de tarea
	 * @return string
	 */
	public function getDescripcion(){
		return "tipoTarea.general.descripcion";
	}


	/**
	 * código del tipo de tarea
	 * @return string
	 */
	public function getCodigo(){
		return "tipoTarea.general.codigo";
	}

}
?>