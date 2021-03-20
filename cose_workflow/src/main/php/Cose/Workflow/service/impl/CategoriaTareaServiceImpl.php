<?php
namespace Cose\Workflow\service\impl;

use Cose\Workflow\dao\DAOFactory;

/**
 * servicio para CategoriaTarea
 *  
 * @author Bernardo
 * @since 01-09-2015
 *
 */
use Cose\Catalogo\service\impl\CatalogoServiceImpl;

class CategoriaTareaServiceImpl extends CatalogoServiceImpl{
	

	protected function getDAO(){
		return DAOFactory::getCategoriaTareaDAO();
	}

	protected function getNombreRequeridoMsg(){
		return "categoriaTarea.nombre.requerido";
	}
	
	protected function getNombreRepeditoMsg(){
		return "categoriaTarea.nombre.repetido";
	}
	
	
	protected function getCodigoRequeridoMsg(){
		return "categoriaTarea.codigo.requerido";
	}
	
	protected function getCodigoRepetidoMsg(){
		return "categoriaTarea.codigo.repetido";
	}
}