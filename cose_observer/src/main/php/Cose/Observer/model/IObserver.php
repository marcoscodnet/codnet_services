<?php

namespace Cose\Observer\model;

/**
 * Observador de cambios.
 * 
 * @author bernardo
 * @since 06/09/2013
 */
interface IObserver{

	function getCode();
	
	function setCode( $value );
	
	function getName();

	function setName( $value );
	
	function notify(IEvent $event );

}