<?php

namespace Cose\Workflow\model;

/**
 * Estado de tareas 
 *  
 * @author Bernardo
 * @since 01-09-2015
 */

class EstadoTarea {
    
    const Pendiente = 1;
    const EnProceso = 2;
    const Resuelta = 3;
    const Cancelada = 4;
    
    private static $items = array(  
    								   self::Pendiente => "tarea.pendiente.label",
    								   self::EnProceso => "tarea.enproceso.label",
    								   self::Resuelta => "tarea.resuelta.label",
    								   self::Cancelada => "tarea.cancelada.label",
    								   );

	
	public static function getItems(){
		return self::$items;
	}
	
	public static function getLabel($value){
		return self::$items[$value];
	}

}
?>