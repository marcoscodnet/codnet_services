<?php
namespace Cose\Observer\service;

use Cose\Observer\model\IEvent;

/**
 * Trigger para lanzar un evento al servidor websocket.
 * 
 * @author bernardo
 *
 */
interface ITriggerService {


	/**
	 * se avisa al server websocket que se produjo un evento
	 * 
	 * @param IEvent $event
	 */
	function trigger( IEvent $event, $url, $port );
	
}