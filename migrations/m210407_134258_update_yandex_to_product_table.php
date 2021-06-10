<?php

use yii\db\Migration;

/**
 * Class m210407_134258_update_yandex_to_product_table
 */
class m210407_134258_update_yandex_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('yandex_product_stat','id',$this->primaryKey());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210407_134258_update_yandex_to_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210407_134258_update_yandex_to_product_table cannot be reverted.\n";

        return false;
    }
    */
}
