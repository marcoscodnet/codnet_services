<?php
namespace Cose\Catalogo\dao\impl;


/**
 * dao para EstadoCivil
 *  
 * @author Bernardo
 * @since 24-08-2015
 * 
 */

use Cose\Catalogo\model\EstadoCivil;

class EstadoCivilDoctrineDAO extends CatalogoDoctrineDAO{
	
	protected function getClazz(){
		return get_class( new EstadoCivil() );
	}
	
}