<?php
namespace Cose\Catalogo\dao\impl;


/**
 * dao para Genero
 *  
 * @author Bernardo
 * @since 24-08-2015
 * 
 */

use Cose\Catalogo\model\Genero;

class GeneroDoctrineDAO extends CatalogoDoctrineDAO{
	
	protected function getClazz(){
		return get_class( new Genero() );
	}
	
}