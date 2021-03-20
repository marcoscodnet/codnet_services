<?php
namespace Cose\Observer\service\impl;

use Cose\Observer\service\ITriggerService;

use Cose\Observer\model\IEvent;

/**
 * Trigger para lanzar un evento al servidor websocket.
 * 
 * @author bernardo
 *
 */
class TriggerService implements ITriggerService{


	/**
	 * se avisa al server websocket que se produjo un evento
	 * 
	 * @param IEvent $event
	 */
	public function trigger( IEvent $event, $host, $port ){
	
		    $sk=fsockopen($host,$port,$errnum,$errstr,$timeout) ;
    		if (!is_resource($sk)) {
    			exit("connection fail: ".$errnum." ".$errstr) ;
    		} else {
    			fputs($sk, "hello world") ;
    			$dati="" ;
    			while (!feof($sk)) {
    				$dati.= fgets ($sk, 1024);
    			}
    		}
    		fclose($sk) ;
    		echo($dati) ;
	}
	
}