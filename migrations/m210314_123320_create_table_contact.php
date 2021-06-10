<?php

use yii\db\Migration;

/**
 * Class m210314_123320_create_table_contact
 */
class m210314_123320_create_table_contact extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(32)->notNull(),
            'tel'=>$this->string(21)->notNull(),
            'email'=>$this->string(64),
            'message'=>$this->string(500)->notNull(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210314_123320_create_table_contact cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210314_123320_create_table_contact cannot be reverted.\n";

        return false;
    }
    */
}
