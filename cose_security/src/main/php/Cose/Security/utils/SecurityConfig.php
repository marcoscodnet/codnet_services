<?php
namespace Cose\Security\conf;

use Cose\utils\Logger;

/**
 * configuración para security
 *  
 * @author bernardo
 *
 */
class SecurityConfig {

	/**
	 * singleton instance
	 * @var SecurityConfig
	 */
	private static $instance;
	
	
	private function __construct(){

	}
	
	public static function getInstance(){
		if (  !self::$instance instanceof self ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	

	public static function setInstance($instance)
	{
	    self::$instance = $instance;
	}


}