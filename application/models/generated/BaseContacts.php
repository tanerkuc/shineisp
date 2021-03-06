<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Contacts', 'doctrine');

/**
 * BaseContacts
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $contact_id
 * @property string $contact
 * @property integer $type_id
 * @property integer $base
 * @property integer $customer_id
 * @property ContactsTypes $ContactsTypes
 * @property Customers $Customers
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContacts extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('contacts');
        $this->hasColumn('contact_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('contact', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '100',
             ));
        $this->hasColumn('type_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '4',
             ));
        $this->hasColumn('base', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => '1',
             ));
        $this->hasColumn('customer_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'autoincrement' => false,
             'length' => '4',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ContactsTypes', array(
             'local' => 'type_id',
             'foreign' => 'type_id'));

        $this->hasOne('Customers', array(
             'local' => 'customer_id',
             'foreign' => 'customer_id',
             'onDelete' => 'CASCADE'));
    }
}