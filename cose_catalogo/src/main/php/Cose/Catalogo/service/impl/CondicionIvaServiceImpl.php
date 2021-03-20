<?php
namespace Cose\Catalogo\service\impl;

/**
 * servicio para CondicionIva
 *  
 * @author bernardo
 * @since 26-08-2015
 */
use Cose\Catalogo\dao\DAOFactory;

class CondicionIvaServiceImpl extends CatalogoServiceImpl{
	

	protected function getDAO(){
		return DAOFactory::getCondicionIvaDAO();
	}

	protected function getNombreRequeridoMsg(){
		return "condicionIva.nombre.requerido";
	}
	
	protected function getNombreRepeditoMsg(){
		return "condicionIva.nombre.repetido";
	}
	
	
	protected function getCodigoRequeridoMsg(){
		return "condicionIva.codigo.requerido";
	}
	
	protected function getCodigoRepetidoMsg(){
		return "condicionIva.codigo.repetido";
	}
}