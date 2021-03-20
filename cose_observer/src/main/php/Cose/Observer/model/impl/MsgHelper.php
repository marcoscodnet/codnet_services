<?php

namespace Cose\Observer\model\impl;

use Cose\Observer\model\impl\Event;

/**
 * Colabora con los mensajes
 * 
 * @author bernardo
 * @since 10/09/2013
 */

class MsgHelper {

	/**
	 * dado un mensaje forma un evento
	 * @param string $msg
	 * @return Event
	 */
	public static function build($msg){

		$json = str_replace(array("\n","\r"),"",$msg);
	    $json = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/','$1"$3":',$json);
	    $json = preg_replace('/(,)\s*}$/','}',$json);
    
	    echo "json $json\n";
	    
		$messageData = json_decode( $json, true );
				
		var_dump($messageData);
		
		return $messageData;
	}
	
	public static function hasType($messageData){
	
		return array_key_exists("type", $messageData);
		
	}
	
	public static function getType($messageData){
	
		if( self::hasType($messageData))
			return $messageData["type"];
		else return null;	
	}
	
	public static function getEventType($messageData){
	
		if( array_key_exists("eventType",$messageData) )
			return $messageData["eventType"];
		else "all";	
	}

	public static function getParams($messageData){
	
		return array();
		
		if( array_key_exists("params",$messageData) )
			return $messageData["params"];
		else return array();	
	}
	
	public static function isSubscription($messageData){
	
		return Subject::MESSAGE_TYPE_SUBSCRIPTION == self::getType($messageData);
	}
	
	public static function isUnsubscription($messageData){
	
		return Subject::MESSAGE_TYPE_UNSUBSCRIPTION == self::getType($messageData);
	}
	
	public static function isModelChange($messageData){
	
		return Subject::MESSAGE_TYPE_MODEL_CHANGE == self::getType($messageData);
	}
}