<?php
namespace Cose\Catalogo\service\impl;

/**
 * servicio para EstadoCivil
 *  
 * @author bernardo
 * @since 26-08-2015
 */
use Cose\Catalogo\dao\DAOFactory;

class EstadoCivilServiceImpl extends CatalogoServiceImpl{
	

	protected function getDAO(){
		return DAOFactory::getEstadoCivilDAO();
	}

	protected function getNombreRequeridoMsg(){
		return "estadoCivil.nombre.requerido";
	}
	
	protected function getNombreRepeditoMsg(){
		return "estadoCivil.nombre.repetido";
	}
	
	
	protected function getCodigoRequeridoMsg(){
		return "estadoCivil.codigo.requerido";
	}
	
	protected function getCodigoRepetidoMsg(){
		return "estadoCivil.codigo.repetido";
	}
}