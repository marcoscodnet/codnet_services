<?php

namespace Cose\Observer\model;

/**
 * Evento que dispara la notificación.
 * 
 * @author bernardo
 * @since 06/09/2013
 */
interface IEvent{

	/**
	 * Disparador del evento.
	 * @return IObsever
	 */
	function getFrom();

	function setFrom(IObserver $observer);
	
	/**
	 * Destinatario del evento
	 * Pueder ser nulo, en ese caso es como un broadcast
	 * @return IObsever
	 */
	function getTo();
	
	function setTo(IObserver $observer);
	
	/**
	 * Parámetros
	 * @returno array
	 */
	function getParams();
	
	function setParams(array $params=null);
	
	/**
	 * Tipo de evento.
	 * @return int
	 */
	function getEventType();
	
	function setEventType($type);

}