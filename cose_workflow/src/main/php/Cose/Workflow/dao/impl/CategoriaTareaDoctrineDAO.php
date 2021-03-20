<?php
namespace Cose\Workflow\dao\impl;


use Cose\Workflow\model\CategoriaTarea;

use Cose\Catalogo\dao\impl\CatalogoDoctrineDAO;

use Cose\criteria\ICriteria;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para CategoriaTarea
 *  
 * @author Bernardo
 * @since 01-09-2015
 * 
 */
class CategoriaTareaDoctrineDAO extends CatalogoDoctrineDAO{
	
	protected function getClazz(){
		return get_class( new CategoriaTarea() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('c', 'p'))
	   				->from( $this->getClazz(), "c")
	   				->leftjoin( "c.padre", "p");
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(c.oid)')
	   				->from( $this->getClazz(), "c")
	   				->leftjoin( "c.padre", "p");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		parent::enhanceQueryBuild($queryBuilder, $criteria);
		
		$padre = $criteria->getPadre();
		if( $padre !=null ){
			$queryBuilder->andWhere( "p.oid = :poid");
			$queryBuilder->setParameter( "poid" , $padre->getOid() );
		}

		$padreIsNull = $criteria->getPadreIsNull();
		if( $padreIsNull ){
			$queryBuilder->andWhere( "p is null");
		}
		
	}	
	
	
}