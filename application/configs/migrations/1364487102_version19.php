<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version19 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('products', 'uuid', 'string', '40', array(
             ));
    }

    public function down()
    {

    }
}