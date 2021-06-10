<?php

use yii\db\Migration;

/**
 * Class m210217_175809_update_catalog_table
 */
class m210217_175809_update_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('catalog', 'name', $this->string(1024)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210217_175809_update_catalog_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210217_175809_update_catalog_table cannot be reverted.\n";

        return false;
    }
    */
}
