<?php
namespace Cose\Geo\dao\impl;

use Cose\Geo\model\Provincia;

use Cose\Geo\dao\IProvinciaDAO;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Provincia
 *  
 * @author Bernardo
 * @since 20-08-2015
 * 
 */
class ProvinciaDoctrineDAO extends CrudDAO implements IProvinciaDAO{
	

	protected function getClazz(){
		return get_class( new Provincia() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('p'))
	   				->from( $this->getClazz(), "p")
	   				->leftJoin('p.pais', 'pa');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(p.oid)')
	   				->from( $this->getClazz(), "p")
	   				->leftJoin('p.pais', 'pa');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "p.oid <> $oid");
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "p.nombre like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}

		$codigo = $criteria->getCodigo();
		if( !empty($codigo) ){
			$queryBuilder->andWhere( "p.codigo = :codigo");
			$queryBuilder->setParameter( "codigo" , $codigo );
		}

		$pais = $criteria->getPais();
		if( !empty($pais) ){
			//echo($pais); die();
			$paisOid = $pais->getOid();
			$queryBuilder->andWhere( "pa.oid = $paisOid");
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "p.$name";	
		}	
		
	}	
}