<?php

use yii\db\Migration;

/**
 * Class m210219_151720_update_brand_table
 */
class m210219_151720_update_brand_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('brand', 'description', $this->text());
        $this->alterColumn('product', 'description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210219_151720_update_brand_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210219_151720_update_brand_table cannot be reverted.\n";

        return false;
    }
    */
}
