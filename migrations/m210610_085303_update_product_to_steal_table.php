<?php

use yii\db\Migration;

/**
 * Class m210610_085303_update_product_to_steal_table
 */
class m210610_085303_update_product_to_steal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_to_steal','rateName',$this->integer());
        $this->addColumn('product_to_steal','rateNameNumbers',$this->boolean());
        $this->addColumn('product_to_steal','rateDescription',$this->integer());
        $this->addColumn('product_to_steal','rateProperty',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210610_085303_update_product_to_steal_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210610_085303_update_product_to_steal_table cannot be reverted.\n";

        return false;
    }
    */
}
