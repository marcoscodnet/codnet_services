<?php

namespace Cose\Observer\model\impl;

use Cose\Observer\model\impl\Event;

/**
 * Encargado de crear un evento a partir del
 * mensaje en formato json.
 * 
 * @author bernardo
 * @since 06/09/2013
 */

class EventBuilder {

	/**
	 * dado un mensaje forma un evento
	 * @param string $msg
	 * @return Event
	 */
	public static function buildEvent($msg){

		$event = new Event();
		
		$data = json_decode($json, true);

		
		
		
		return $event;
	}
}