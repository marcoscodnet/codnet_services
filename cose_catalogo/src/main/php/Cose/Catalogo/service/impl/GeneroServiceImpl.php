<?php
namespace Cose\Catalogo\service\impl;

/**
 * servicio para Genero
 *  
 * @author bernardo
 * @since 26-08-2015
 */
use Cose\Catalogo\dao\DAOFactory;

class GeneroServiceImpl extends CatalogoServiceImpl{
	

	protected function getDAO(){
		return DAOFactory::getGeneroDAO();
	}

	protected function getNombreRequeridoMsg(){
		return "genero.nombre.requerido";
	}
	
	protected function getNombreRepeditoMsg(){
		return "genero.nombre.repetido";
	}
	
	
	protected function getCodigoRequeridoMsg(){
		return "genero.codigo.requerido";
	}
	
	protected function getCodigoRepetidoMsg(){
		return "genero.codigo.repetido";
	}
}