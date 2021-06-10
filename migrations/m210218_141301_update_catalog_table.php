<?php

use yii\db\Migration;

/**
 * Class m210218_141301_update_catalog_table
 */
class m210218_141301_update_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('catalog', 'status', $this->integer()->notNull()->defaultValue(1));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210218_141301_update_catalog_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210218_141301_update_catalog_table cannot be reverted.\n";

        return false;
    }
    */
}
