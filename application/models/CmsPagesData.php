<?php

/**
 * CmsPagesData
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class CmsPagesData extends BaseCmsPagesData
{
    /**
     * Get a record by ID
     * 
     * @param $pageid
     * @param $locale
     * @return Doctrine Record
     */
    public static function findbyPageDatabyID($pageid, $language_id = null) {
		if ( $language_id === null ) {
			$Session = new Zend_Session_Namespace ( 'Admin' );
			$language_id = $Session->langid;
		}        
    	
    	$record = Doctrine_Core::getTable('CmsPagesData')
				    ->createQuery('u')
				    ->addWhere ( "page_id = ?", $pageid )
                    ->addWhere ( "language_id = ?", $language_id )
				    ->fetchOne();
	
        return $record;
    }
    
	/**
	 * delete
	 * Delete a record by ID
	 * @param $id
	 */
	public static function deleteItems($id) {
		Doctrine::getTable ( 'CmsPagesData' )->findBy ( 'page_id', $id )->delete ();
	}
	
	/**
	 * Get the list of the languages by page_id
	 * 
	 *  
	 * @param integer $index
	 */
	public static function getTranslations($pageid){
		$items = array();
		$records = Doctrine_Query::create ()->from ( 'CmsPagesData' )
										    ->where ( "page_id = ?", $pageid )
										    ->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
		foreach ($records as $record) {
				$items[] = Languages::getLanguageLabel($record['language_id']);
		}
		
		return implode(", ", $items);
	}
}