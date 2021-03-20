<?php
namespace Cose\Catalogo\service\impl;

/**
 * servicio para TipoDocumento
 *  
 * @author bernardo
 * @since 26-08-2015
 */
use Cose\Catalogo\dao\DAOFactory;

class TipoDocumentoServiceImpl extends CatalogoServiceImpl{
	

	protected function getDAO(){
		return DAOFactory::getTipoDocumentoDAO();
	}

	protected function getNombreRequeridoMsg(){
		return "tipoDocumento.nombre.requerido";
	}
	
	protected function getNombreRepeditoMsg(){
		return "tipoDocumento.nombre.repetido";
	}
	
	
	protected function getCodigoRequeridoMsg(){
		return "tipoDocumento.codigo.requerido";
	}
	
	protected function getCodigoRepetidoMsg(){
		return "tipoDocumento.codigo.repetido";
	}
}