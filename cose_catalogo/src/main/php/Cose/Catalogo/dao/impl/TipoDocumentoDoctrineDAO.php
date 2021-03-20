<?php
namespace Cose\Catalogo\dao\impl;


/**
 * dao para TipoDocumento
 *  
 * @author Bernardo
 * @since 24-08-2015
 * 
 */

use Cose\Catalogo\model\TipoDocumento;

class TipoDocumentoDoctrineDAO extends CatalogoDoctrineDAO{
	
	protected function getClazz(){
		return get_class( new TipoDocumento() );
	}
	
}