<?php

namespace Cose\Observer\model;

/**
 * Responsable de notificar los cambios
 * a los observers.
 * 
 * @author bernardo
 * @since 06/09/2013
 */
interface ISubject{

	/**
	 * Se agrega un observador para notificarse
	 * sobre eventos de un tipo determinado
	 * @param IObserver $observer
	 * @param int $eventType
	 */
	function subscribe(IObserver $observer,  $eventType=null);

	/**
	 * Un observador indica que quiere dejar de ser notificado
	 * sobre eventos de un tipo determinado
	 * @param IObserver $observer
	 * @param int $eventType
	 */
	function unsubscribe(IObserver $observer, $eventType=null);
	
	/**
	 * se notifica a los observadores del evento (dado el tipo) sobre
	 * el evento ocurrido.
	 * 
	 * @param $event
	 */
	function notify(IEvent $event);
	
	
	/**
	 * un observer avisa al subject que algo nuevo
	 * sobre un evento/cambio que produjo
	 * 
	 * @param IObserver $observer
	 * @param IEvent $event
	 */
	function advise(IObserver $observer, IEvent $event);
	
	
}