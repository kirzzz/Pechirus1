<?php

use yii\db\Migration;

/**
 * Class m210613_092057_update_log_table
 */
class m210613_092057_update_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('log','type_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210613_092057_update_log_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210613_092057_update_log_table cannot be reverted.\n";

        return false;
    }
    */
}
