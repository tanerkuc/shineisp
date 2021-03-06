<?php

/**
 * ProductsAttributesGroups
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ShineISP
 * 
 * @author     Shine Software <info@shineisp.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ProductsAttributesGroups extends BaseProductsAttributesGroups
{

	/**
	 * grid
	 * create the configuration of the grid
	 */	
	public static function grid($rowNum = 10) {
		
		$translator = Shineisp_Registry::getInstance ()->Zend_Translate;
		
		$config ['datagrid'] ['columns'] [] = array ('label' => null, 'field' => 'group_id', 'alias' => 'group_id', 'type' => 'selectall' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'ID' ), 'field' => 'group_id', 'alias' => 'group_id', 'sortable' => true, 'searchable' => true, 'type' => 'string' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'Name' ), 'field' => 'name', 'alias' => 'name', 'sortable' => true, 'searchable' => true, 'type' => 'string' );
		$config ['datagrid'] ['fields'] = "group_id, name as name";
		
		$config ['datagrid'] ['dqrecordset'] = Doctrine_Query::create ()->select ( $config ['datagrid'] ['fields'] )->from ( 'ProductsAttributesGroups pag' );
		
		$config ['datagrid'] ['rownum'] = $rowNum;
		
		$config ['datagrid'] ['basepath'] = "/admin/productsattributesgroups/";
		$config ['datagrid'] ['index'] = "group_id";
		$config ['datagrid'] ['rowlist'] = array ('10', '50', '100', '1000' );
		
		$config ['datagrid'] ['buttons'] ['edit'] ['label'] = $translator->translate ( 'Edit' );
		$config ['datagrid'] ['buttons'] ['edit'] ['cssicon'] = "edit";
		$config ['datagrid'] ['buttons'] ['edit'] ['action'] = "/admin/productsattributesgroups/edit/id/%d";
		
		$config ['datagrid'] ['buttons'] ['delete'] ['label'] = $translator->translate ( 'Delete' );
		$config ['datagrid'] ['buttons'] ['delete'] ['cssicon'] = "delete";
		$config ['datagrid'] ['buttons'] ['delete'] ['action'] = "/admin/productsattributesgroups/delete/id/%d";
		return $config;
	}
		
	/*
	 * find
	 * Find an item by its id
	 */
	public static function find($id){
		return Doctrine::getTable ( 'ProductsAttributesGroups' )->find ( $id );
	}
		
	/*
	 * Find an item by its code
	 */
	public static function findbyCode($code){
		return Doctrine::getTable ( 'ProductsAttributesGroups' )->findBy('Code', $code);
	}
	
	/*
	 * DeleteItems
	 * Delete a group of records
	 */
	public static function DeleteItems($items){
		Doctrine_Query::create ()->delete ()->from ( 'ProductsAttributesGroups pag' )->whereIn ( 'pag.group_id', $items )->execute ();
	}
	
	/*
	 * DeleteGroup
	 * Delete a group 
	 */
	public static function DeleteGroup($id) {
		Doctrine::getTable ( 'ProductsAttributesGroups' )->find ( $id )->delete();
	}
	
	
    /**
     * getAllInfo
     * Get a record by ID
     * @param $id
     * @return ARRAY Record
     */
    public static function getAllInfo($id, $fields = "*", $language_id = 1) {
        try {
            $dq = Doctrine_Query::create ()
					            ->from ( 'ProductsAttributesGroups pag' )
					            ->where ( 'pag.group_id = ?', $id );
					            
            if($fields != "*"){
            	$dq->select($fields);
            }
            
            $hp = $dq->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
            
            if (isset ( $hp [0] )) {
                return $hp [0];
            } else {
                return array ();
            }
        
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }   
	
    /**
     * getAttributes
     * Get all the attributes within the selected group
     * @param $id
     * @return ARRAY Record
     */
    public static function getAttributes($id) {
        try {
        	$attributes = array();
            $records = Doctrine_Query::create ()
            ->select('attribute_id')
            ->from ( 'ProductsAttributesGroupsIndexes p' )
            ->where ( 'p.group_id = ?', $id )
            ->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
            
            
	        foreach ( $records as $c ) {
				$attributes [] = $c ['attribute_id'];
			}
			
            return $attributes;
        
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }   
	
    /**
     * Get all the attributes within the selected group
     * 
     * @param $id
     * @return ARRAY Record
     */
    public static function getGroupByProductId($id) {
        try {
            $product = Doctrine_Query::create ()
							            ->select('group_id')
							            ->from ( 'Products p' )
							            ->where ( 'p.product_id = ?', $id )
							            ->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
            
            if(!empty($product[0]['group_id'])){
            	return $product[0]['group_id'];
            }
            
            return NULL;
        
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }   
	
    /**
     * Get all the groups where the attribute has been joined
     * 
     * 
     * @param $attributeid
     * @return ArrayObject
     */
    public static function getGroups($attributeid, $locale=1) {
        try {
            return Doctrine_Query::create ()
						            ->from ( 'ProductsAttributesGroupsIndexes p' )
						            ->leftJoin( 'p.ProductsAttributesGroups pag' )
						            ->where ( 'p.attribute_id = ?', $attributeid )
						            ->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
            
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }   
	
    /**
     * getAttributesProfiles
     * Get all the attributes within the selected group
     * @param $id
     * @return ARRAY Record
     */
    public static function getAttributesProfiles($id, $locale=1) {
        try {
            $records = Doctrine_Query::create ()
            ->from ( 'ProductsAttributesGroupsIndexes pi' )
            ->leftJoin( 'pi.ProductsAttributes pa' )
            ->leftJoin( 'pa.ProductsAttributesData pd WITH pd.language_id = ' . $locale )
            ->where ( 'pi.group_id = ?', $id )
            ->orderBy('pa.position asc')
            ->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
            
            return $records;
        
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }   
    
	/*
     * getList
     * get the attribute group list 
     */
	public static function getList($empty = false, $getRecurringServices=false) {
		$records = array ();
		if ($empty) {
			$items [] = "";
		}
		
		$dq = Doctrine_Query::create ()->from ( 'ProductsAttributesGroups pag' );
		
		if($getRecurringServices){
			$dq->where ( 'pag.isrecurring = ?', $getRecurringServices );
		}
		
		
		$items = $dq->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
		foreach ( $items as $c ) {
			$records [$c ['group_id']] = $c ['name'];
		}
		
		return $records;
	}
	
	/**
	 * Add a group attribute
	 * 
	 * @param string $name
	 * @param boolean $is_recurring
	 * @param boolean $is_comparable
	 */
	public static function addNew($id=NULL, $name, $is_recurring=0, $is_comparable=0){

		if(is_numeric($id)){
			$group = self::find($id);	
		}else{
			$group = new ProductsAttributesGroups();
		}
		
		$group['name'] = $name;
		$group['code'] = Shineisp_Commons_UrlRewrites::format($name);
		$group['isrecurring'] = $is_recurring;
		$group['iscomparable'] = $is_comparable;
		$group->save ();
		
		return $group['group_id'];
	}
    
}