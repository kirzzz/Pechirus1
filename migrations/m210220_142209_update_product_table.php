<?php

use yii\db\Migration;

/**
 * Class m210220_142209_update_product_table
 */
class m210220_142209_update_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('product', 'idCatalogChild');
        $this->alterColumn('product', 'name',$this->string(512));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210220_142209_update_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210220_142209_update_product_table cannot be reverted.\n";

        return false;
    }
    */
}
