<?php
namespace Cose\Security\utils;

use Cose\utils\Logger;
use Cose\utils\CoseUtils;
/**
 * configuración para security
 *  
 * @author bernardo
 *
 */
class SecurityUtils {

	//AES
	const AES_PRIVATE_KEY = "C05E5ECURT1C05E5";
		
	/**
	 * encripta el valor con AES
	 * @param string $value
	 */
	public static function aesEncrypt( $value ){
	
		if(!empty($value))
			$encrypted = CoseUtils::aesEncrypt( $value, self::AES_PRIVATE_KEY );
		else
			$encrypted = "";
		
		return $encrypted;
		
	}
	
	/**
	 * desencripta el valor AES
	 * @param string $encrypted
	 */
	public static function aesDecrypt( $encrypted ){
		
		if(!empty($encrypted))
			$decrypted = CoseUtils::aesDecrypt($encrypted, self::AES_PRIVATE_KEY );
		else	
			$decrypted = ""; 
		return $decrypted;
		
		
	}
}