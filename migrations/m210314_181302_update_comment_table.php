<?php

use yii\db\Migration;

/**
 * Class m210314_181302_update_comment_table
 */
class m210314_181302_update_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('comments','idUser',$this->integer());
        $this->alterColumn('comments','status',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210314_181302_update_comment_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210314_181302_update_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
