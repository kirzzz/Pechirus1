<?php

use yii\db\Migration;

/**
 * Class m210311_181209_update_orders_table
 */
class m210311_181209_update_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('orders', 'regionOfDelivery',$this->integer());

        $this->alterColumn('orders', 'address',$this->string(512));
        $this->dropColumn('orders', 'type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210311_181209_update_orders_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210311_181209_update_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
