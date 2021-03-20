<?php
namespace Cose\Catalogo\dao\impl;


/**
 * dao para CondicionIva
 *  
 * @author Bernardo
 * @since 24-08-2015
 * 
 */

use Cose\Catalogo\model\CondicionIva;

class CondicionIvaDoctrineDAO extends CatalogoDoctrineDAO{
	
	protected function getClazz(){
		return get_class( new CondicionIva() );
	}
	
}