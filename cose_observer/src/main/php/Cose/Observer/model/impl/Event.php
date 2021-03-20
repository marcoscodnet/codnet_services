<?php

namespace Cose\Observer\model\impl;

/**
 * Implementación de un evento.
 * 
 * @author bernardo
 * @since 06/09/2013
 */
use Cose\Observer\model\IObserver;

use Cose\Observer\model\IEvent;

class Event implements IEvent{

	/**
	 * @var IObserver
	 */
	private $from;

	/**
	 * @var IObserver
	 */
	private $to;
	
	/**
	 * @var array
	 */
	private $params;
	
	/**
	 * @var int
	 */
	private $type;
	


	public function getFrom()
	{
	    return $this->from;
	}

	public function setFrom(IObserver $from)
	{
	    $this->from = $from;
	}

	public function getTo()
	{
	    return $this->to;
	}

	public function setTo(IObserver $to)
	{
	    $this->to = $to;
	}

	public function getParams()
	{
	    return $this->params;
	}

	public function setParams(array $params=null)
	{
	    $this->params = $params;
	}

	public function getEventType()
	{
	    return $this->type;
	}

	public function setEventType($type)
	{
	    $this->type = $type;
	}
}