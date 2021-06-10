<?php

use yii\db\Migration;

/**
 * Class m210309_075921_update_product_table
 */
class m210309_075921_update_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('product', 'img',$this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210309_075921_update_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210309_075921_update_product_table cannot be reverted.\n";

        return false;
    }
    */
}
