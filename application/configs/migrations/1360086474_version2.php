<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version2 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('dns_zones', 'updating_date', 'timestamp', '25', array(
             'notnull' => '1',
             ));
        $this->changeColumn('panels_actions', 'start', 'timestamp', '25', array(
             'notnull' => '1',
             ));
        $this->changeColumn('panels_actions', 'end', 'timestamp', '25', array(
             ));
        $this->changeColumn('tickets', 'date_open', 'timestamp', '25', array(
             'notnull' => 'true;',
             ));
        $this->changeColumn('tickets', 'date_updated', 'timestamp', '25', array(
             ));
        $this->changeColumn('tickets', 'date_close', 'timestamp', '25', array(
             ));
        $this->changeColumn('tickets_notes', 'date_post', 'timestamp', '25', array(
             ));
    }

    public function down()
    {

    }
}