<?php
namespace Cose\Geo\dao\impl;

use Cose\Geo\model\Localidad;

use Cose\Geo\dao\ILocalidadDAO;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Localidad
 *  
 * @author Bernardo
 * @since 20-08-2015
 * 
 */
class LocalidadDoctrineDAO extends CrudDAO implements ILocalidadDAO{
	

	protected function getClazz(){
		return get_class( new Localidad() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('l'))
	   				->from( $this->getClazz(), "l")
	   				->leftJoin('l.provincia', 'p');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(l.oid)')
	   				->from( $this->getClazz(), "l")
	   				->leftJoin('l.provincia', 'p');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "l.oid <> $oid");
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "l.nombre like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}

		$codigoPostal = $criteria->getCodigoPostal();
		if( !empty($codigoPostal) ){
			$queryBuilder->andWhere( "l.codigoPostal = :codigoPostal");
			$queryBuilder->setParameter( "codigoPostal" , $codigoPostal );
		}

		$provincia = $criteria->getProvincia();
		if( $provincia != null ){
			$provinciaOid = $provincia->getOid();
			$queryBuilder->andWhere( "p.oid = $provinciaOid");
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "l.$name";	
		}	
		
	}	
}