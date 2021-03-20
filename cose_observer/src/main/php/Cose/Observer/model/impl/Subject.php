<?php

namespace Cose\Observer\model\impl;

use Cose\Observer\model\IEvent;

use Cose\Observer\model\IEventType;

use Cose\Observer\model\IObserver;

use Cose\Observer\model\ISubject;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

/**
 * Subject es el responsable de notificar los cambios
 *
 * @author bernardo
 * @since 6-09-2013
 *
 */
class Subject implements MessageComponentInterface, ISubject {
	
	/**
	 * websocket clients.
	 * @var \SplObjectStorage
	 */
 	protected $clients;

 	/**
 	 * observers
 	 * @var array
 	 */
 	protected $observers;

 	/*
 	 * tipos de mensajes que puede recibir el subject. 
 	 */
 	const MESSAGE_TYPE_SUBSCRIPTION="subscription";
 	const MESSAGE_TYPE_UNSUBSCRIPTION="unsubscription";
 	const MESSAGE_TYPE_MODEL_CHANGE="model-change";
 	
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->observers = array();
    }

    
    /* ISubject */

    /**
     * (non-PHPdoc)
     * @see src/main/php/Cose/Observer/model/Cose\Observer\model.ISubject::subscribe()
     */
    public function subscribe(IObserver $observer, $eventType=null){
    	
    	if( $eventType==null)
    		$eventType="all";
    	
    	if( !array_key_exists($eventType, $this->observers))
    		$this->observers[$eventType] = array();
    		
    	$this->observers[$eventType][$observer->getCode()] = $observer;
    	
    	echo "New subscription on $eventType! ({$observer->getCode()})\n";
    	
    }
    
    /**
     * (non-PHPdoc)
     * @see src/main/php/Cose/Observer/model/Cose\Observer\model.ISubject::unsubscribe()
     */
    public function unsubscribe(IObserver $observer, $eventType=null){
    
    	//si no se indica el tipo de evento, lo desuscribimos de todos.
    	if( $eventType==null ){
	        foreach ($this->observers as $eventType => $observers) {
	        	if( array_key_exists($observer->getCode(), $observers) )
	        	 	unset($observers[$observer->getCode()]);
	        }
	        
    	}else{
    	
    		if( array_key_exists($eventType, $this->observers)){
    		
    			if(array_key_exists($observer->getCode(), $this->observers[$eventType]))

    				unset($this->observers[$eventType][$observer->getCode()]);
    		}
    	
    	}
        
    	
    }

    /**
     * (non-PHPdoc)
     * @see src/main/php/Cose/Observer/model/Cose\Observer\model.ISubject::advise()
     */
    public function advise(IObserver $observer, IEvent $event){
    
		//le agregamos al evento al observer como el disparador.
		$event->setFrom($observer);

		//TODO ver si podemos agregar hacia quién está dirigido
		//por ejemplo, podría venir como parámetro.
		
    	//le avisamos a los observadores correspondientes.
    	$this->notify($event);
    	
    }
    
    /**
     * (non-PHPdoc)
     * @see src/main/php/Cose/Observer/model/Cose\Observer\model.ISubject::notify()
     */
    public function notify(IEvent $event){
    
    	echo "notify to observers on " + $event->getEventType();
    	
    	if( array_key_exists($event->getEventType(), $this->observers)){
	    	foreach ($this->observers[$event->getEventType()] as $myObserver) {
				
	    		//$myObserver->notify($event);
	    		$this->notifyToAnObserver($myObserver, $event);
			}
    	}
		
    	echo "notify to observers on 'all'";
		
    	if(array_key_exists("all", $this->observers)){
			foreach ($this->observers["all"] as $myObserver) {
				
	    		//$myObserver->notify($event);
	    		$this->notifyToAnObserver($myObserver, $event);
			}
		}
    	
    }
    
    private function notifyToAnObserver(IObserver $observer, IEvent $event){
    
    	//si es el mismo que envió no le avisamos.
    	if( $observer->getCode()!= $event->getFrom()->getCode() ){
	    	foreach ($this->clients as $client) {
	            if ($observer->getCode() == $client->resourceId) {
	                
	            	$data = array(
	            			"type" => self::MESSAGE_TYPE_MODEL_CHANGE,
	            			"eventType" => $event->getEventType()
	            	);
	            	
	            	$data["params"] = array();
	            	foreach ($event->getParams() as $key => $value) {
	            		$data["params"]["$key"] = "$value";
	            	}
	            	
	            	
	                $client->send( json_encode($data) );
	            }
	        }
    	}
    }
    
    /* MessageComponentInterface */
    
    /**
     * (non-PHPdoc)
     * @see vendor/cboden/ratchet/src/Ratchet/Ratchet.ComponentInterface::onOpen()
     */
    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
        
        //TODO armar el observer y agregarlo como subscriptor
        $observer = new Observer();
        $observer->setCode($conn->resourceId);
    }

    /**
     * (non-PHPdoc)
     * @see vendor/cboden/ratchet/src/Ratchet/Ratchet.MessageInterface::onMessage()
     */
    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        /*    
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
        */

            
       	/**
		 * TODO trabajar sobre el mensaje.
		 * podría ser algo en json.
		 * 
		 * 3 posibles mensajes:
		 *   subscribe, unsubscribe, o model-change
		 *   
		 *  
		 */	

        //armar el mensaje
        $messageData = MsgHelper::build($msg);
        
        
        if( MsgHelper::hasType($messageData) ){
        
        	$type = MsgHelper::getType($messageData);
        	$eventType = MsgHelper::getEventType($messageData);
        	
		    echo "Message type $type \n";
		    echo "Message eventtype $type \n";
		    
	        if( MsgHelper::isSubscription($messageData) ){
		        	
		        	$observer = new Observer();
		        	$observer->setCode($from->resourceId);
		        	$this->subscribe($observer, $eventType);
		        	
			}elseif( MsgHelper::isUnsubscription($messageData) ){
		        	
		        	$observer = new Observer();
		        	$observer->setCode($from->resourceId);
		        	$this->unsubscribe($observer, $eventType);
		        	
			}elseif( MsgHelper::isModelChange($messageData) ){
		        	
		        	$observer = new Observer();
		        	$observer->setCode($from->resourceId);
		        	
		        	$params = MsgHelper::getParams($messageData);
		        	
		        	$event = new Event();
		        	$event->setFrom($observer);
		        	$event->setEventType($eventType);
		        	$event->setParams($params);
		        	$this->notify($event);
			}
        }else{
				echo "Message nothing \n";
		}
        
    }

    /**
     * (non-PHPdoc)
     * @see vendor/cboden/ratchet/src/Ratchet/Ratchet.ComponentInterface::onClose()
     */
    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
        
        //armar el observer y desubscribirlo
        $observer = new Observer();
        $observer->setCode($conn->resourceId);

        $this->unsubscribe($observer);
        
    }

    /**
     * (non-PHPdoc)
     * @see vendor/cboden/ratchet/src/Ratchet/Ratchet.ComponentInterface::onError()
     */
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
    
}