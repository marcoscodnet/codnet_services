<?php

/**
 * Realiza la carga y el include de las clases.
 * 
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 04-11-2014
 */

namespace Cose\utils;

class CoseUtils{

	public static function aesEncrypt($val, $privateKey, $blockSize=128){
		
		$aes = new AES($val, $privateKey, $blockSize);
		$enc = $aes->encrypt();
		return $enc;
	}
	
	public static function aesDecrypt($val, $privateKey, $blockSize=128){
		
		$aes = new AES($val, $privateKey, $blockSize);
		$dec=$aes->decrypt();
		return $dec;
	}
	
}	