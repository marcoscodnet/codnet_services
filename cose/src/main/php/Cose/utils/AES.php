<?php
namespace Cose\utils;

/**
 Aes encryption
 */

class AES {
	const M_CBC = 'cbc';
	const M_CFB = 'cfb';
	const M_ECB = 'ecb';
	const M_NOFB = 'nofb';
	const M_OFB = 'ofb';
	const M_STREAM = 'stream';
	protected $key;
	protected $cipher;
	protected $data;
	protected $mode;
	protected $IV;
	/**
	 *
	 * @param type $data
	 * @param type $key
	 * @param type $blockSize
	 * @param type $mode
	 */
	function __construct($data = null, $key = null, $blockSize = null, $mode = null) {
		$this->setData($data);
		$this->setKey($key);
		$this->setBlockSize($blockSize);
		$this->setMode($mode);
		$this->setIV("");
	}
	/**
	 *
	 * @param type $data
	 */
	public function setData($data) {
		$this->data = $data;
	}
	/**
	 *
	 * @param type $key
	 */
	public function setKey($key) {
		$this->key = $key;
	}
	/**
	 *
	 * @param type $blockSize
	 */
	public function setBlockSize($blockSize) {
		/*switch ($blockSize) {
			case 128:
				$this->cipher = MCRYPT_RIJNDAEL_128;
				break;
			case 192:
				$this->cipher = MCRYPT_RIJNDAEL_192;
				break;
			case 256:
				$this->cipher = MCRYPT_RIJNDAEL_256;
				break;
		}*/
		switch ($blockSize) {
			case 128:
				$this->cipher = 'aes-128-cbc';
				break;
			case 192:
				$this->cipher = 'aes-192-cbc';
				break;
			case 256:
				$this->cipher = 'aes-256-cbc';
				break;
		}
	}
	/**
	 *
	 * @param type $mode
	 */
	public function setMode($mode) {
		switch ($mode) {
			case AES::M_CBC:
				$this->mode = MCRYPT_MODE_CBC;
				break;
			case AES::M_CFB:
				$this->mode = MCRYPT_MODE_CFB;
				break;
			case AES::M_ECB:
				$this->mode = MCRYPT_MODE_ECB;
				break;
			case AES::M_NOFB:
				$this->mode = MCRYPT_MODE_NOFB;
				break;
			case AES::M_OFB:
				$this->mode = MCRYPT_MODE_OFB;
				break;
			case AES::M_STREAM:
				$this->mode = MCRYPT_MODE_STREAM;
				break;
			default:
				$this->mode = MCRYPT_MODE_ECB;
				break;
		}
	}
	/**
	 *
	 * @return boolean
	 */
	public function validateParams() {
		if ($this->data != null &&
		$this->key != null &&
		$this->cipher != null) {
			return true;
		} else {
			return FALSE;
		}
	}
	public function setIV($IV) {
		$this->IV = $IV;
	}
	protected function getIV() {
		if ($this->IV == "") {
			//$this->IV = mcrypt_create_iv(mcrypt_get_iv_size($this->cipher, $this->mode), MCRYPT_RAND);
			$this->IV = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
		}
		return $this->IV;
	}
	/**
	 * @return type
	 * @throws Exception
	 */
	public function encrypt() {
		Logger::log($this->key);
		if ($this->validateParams()) {
			/*return trim(base64_encode(
			mcrypt_encrypt(
			$this->cipher, $this->key, $this->data, $this->mode, $this->getIV())));*/
        	$encryption_key = base64_decode($this->key);
    		// Generate an initialization vector
    		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
    		// Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    		$encrypted = openssl_encrypt($this->data, $this->cipher, $encryption_key, 0, $iv);
    		// The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    		return base64_encode($encrypted . '::' . $iv);
			
		} else {
			throw new Exception('Invlid params!');
		}
	}
	/**
	 *
	 * @return type
	 * @throws Exception
	 */
	public function decrypt() {
		
		if ($this->validateParams()) {
			Logger::log($this->key.' - '.$this->data.' - '.$this->cipher);
			/*return trim(mcrypt_decrypt(
			$this->cipher, $this->key, base64_decode($this->data), $this->mode, $this->getIV()));*/
			$encryption_key = base64_decode($this->key);
		    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
		    list($encrypted_data, $iv) = explode('::', base64_decode($this->data), 2);
		    Logger::log($encryption_key.' - '.$encrypted_data.' - '.$iv);
		    $res = openssl_decrypt($encrypted_data, $this->cipher, $encryption_key, 0, $iv);
		    Logger::log('Decr: '.$res);
		    return $res;
		} else {
			throw new Exception('Invlid params!');
		}
	}
}