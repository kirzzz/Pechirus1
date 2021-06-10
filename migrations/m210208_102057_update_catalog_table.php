<?php

use yii\db\Migration;

/**
 * Class m210208_102057_update_catalog_table
 */
class m210208_102057_update_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('catalog', 'idParent', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210208_102057_update_catalog_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210208_102057_update_catalog_table cannot be reverted.\n";

        return false;
    }
    */
}
