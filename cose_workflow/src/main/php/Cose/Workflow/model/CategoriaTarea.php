<?php

namespace Cose\Workflow\model;

use Cose\Catalogo\model\Catalogo;

/**
 * CategoriaTarea
 * 
 * @Entity @Table(name="wkf_categoria_tarea")
 *  
 * @author Bernardo
 * @since 01-09-2015
 */

class CategoriaTarea extends Catalogo{

	/**
     * @ManyToOne(targetEntity="CategoriaTarea",cascade={"merge"})
     * @JoinColumn(name="padre_oid", referencedColumnName="oid")
     * @var CategoriaTarea
     **/
	private $padre;
	

	public function getPadre()
	{
	    return $this->padre;
	}

	public function setPadre($padre)
	{
	    $this->padre = $padre;
	}
}
?>