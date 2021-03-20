<?php
namespace Cose\Workflow\dao;


/**
 * Factory de DAOs
 *  
 * @author bernardo
 *
 */
use Cose\Workflow\dao\impl\CategoriaTareaDoctrineDAO;

use Cose\Workflow\dao\impl\TareaDoctrineDAO;

class DAOFactory {
	
	/**
	 * DAO para CategoriaTarea.
	 * 
	 * @return ICatalogoDAO
	 */
	public static function getCategoriaTareaDAO(){
	
		return new CategoriaTareaDoctrineDAO();	
	}
	
	/**
	 * DAO para Tarea.
	 * 
	 * @return ITareaDAO
	 */
	public static function getTareaDAO(){
	
		return new TareaDoctrineDAO();	
	}
	
}