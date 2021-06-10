<?php

use yii\db\Migration;

/**
 * Class m210314_174643_update_comment_table
 */
class m210314_174643_update_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comments','name',$this->string(32));
        $this->addColumn('comments','email',$this->string(64));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210314_174643_update_comment_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210314_174643_update_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
