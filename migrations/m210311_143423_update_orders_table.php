<?php

use yii\db\Migration;

/**
 * Class m210311_143423_update_orders_table
 */
class m210311_143423_update_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('orders', 'productInfo',$this->text());
        $this->addColumn('orders', 'name',$this->string(32));
        $this->addColumn('orders', 'surname',$this->string(64));
        $this->addColumn('orders', 'tel',$this->string(20));
        $this->addColumn('orders', 'comment',$this->string(512));
        $this->addColumn('orders', 'postalCode',$this->string(12));
        $this->addColumn('orders', 'typeOfDelivery',$this->integer());
        $this->addColumn('orders', 'payment',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210311_143423_update_orders_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210311_143423_update_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
