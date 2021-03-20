<?php

namespace Cose\Workflow\model;

/**
 * Prioridadades de tareas 
 *  
 * @author Bernardo
 * @since 04-09-2015
 */

class PrioridadTarea {
    
    const Baja = 1;
    const Normal = 2;
    const Alta = 3;
    const Urgente = 4;
    
    private static $items = array(  
    								   self::Baja => "prioridad.baja.label",
    								   self::Normal => "prioridad.normal.label",
    								   self::Alta => "prioridad.alta.label",
    								   self::Urgente => "prioridad.urgente.label",
    								   );

	
	public static function getItems(){
		return self::$items;
	}
	
	public static function getLabel($value){
		
		if(array_key_exists($value, self::$items))
		return self::$items[$value];
	}

}
?>