<?php

namespace Cose\Observer\model\impl;

/**
 * Observador de cambios.
 * 
 * @author bernardo
 * @since 06/09/2013
 */
use Cose\Observer\model\IEvent;

use Cose\Observer\model\IObserver;

class Observer implements IObserver{

	private $code;
	
	private $name;
	
	function notify(IEvent $event){
		
	}
	
	public function getCode()
	{
	    return $this->code;
	}

	public function setCode($code)
	{
	    $this->code = $code;
	}

	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}
}