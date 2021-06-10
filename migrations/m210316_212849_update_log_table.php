<?php

use yii\db\Migration;

/**
 * Class m210316_212849_update_log_table
 */
class m210316_212849_update_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('log','action',$this->string(32)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210316_212849_update_log_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210316_212849_update_log_table cannot be reverted.\n";

        return false;
    }
    */
}
