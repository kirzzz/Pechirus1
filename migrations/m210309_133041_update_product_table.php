<?php

use yii\db\Migration;

/**
 * Class m210309_133041_update_product_table
 */
class m210309_133041_update_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'new_price',$this->bigInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210309_133041_update_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210309_133041_update_product_table cannot be reverted.\n";

        return false;
    }
    */
}
