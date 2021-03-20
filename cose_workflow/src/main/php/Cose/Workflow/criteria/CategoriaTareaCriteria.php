<?php
namespace Cose\Workflow\criteria;

use Cose\Catalogo\criteria\CatalogoCriteria;

/**
 * criteria de CategoriaTarea
 *  
 * @author Bernardo
 * @since 01-09-2015
 *
 */
class CategoriaTareaCriteria extends CatalogoCriteria{
	
	private $padre;
	
	private $padreIsNull;
	
	public function getPadre()
	{
	    return $this->padre;
	}

	public function setPadre($padre)
	{
	    $this->padre = $padre;
	}


	public function getPadreIsNull()
	{
	    return $this->padreIsNull;
	}

	public function setPadreIsNull($padreIsNull)
	{
	    $this->padreIsNull = $padreIsNull;
	}
}