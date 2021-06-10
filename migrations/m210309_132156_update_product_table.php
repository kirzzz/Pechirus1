<?php

use yii\db\Migration;

/**
 * Class m210309_132156_update_product_table
 */
class m210309_132156_update_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'hidden',$this->boolean());
        $this->addColumn('product', 'in_stock',$this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210309_132156_update_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210309_132156_update_product_table cannot be reverted.\n";

        return false;
    }
    */
}
