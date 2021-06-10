<?php

use yii\db\Migration;

/**
 * Class m210217_180418_update_catalog_table
 */
class m210217_180418_update_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('name', 'catalog');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210217_180418_update_catalog_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210217_180418_update_catalog_table cannot be reverted.\n";

        return false;
    }
    */
}
