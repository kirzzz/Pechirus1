<?php

use yii\db\Migration;

/**
 * Class m210312_125940_update_order_table
 */
class m210312_125940_update_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('orders','idOrder','article');
        $this->alterColumn('orders', 'article',$this->string(64));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210312_125940_update_order_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210312_125940_update_order_table cannot be reverted.\n";

        return false;
    }
    */
}
