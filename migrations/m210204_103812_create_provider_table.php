<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%provider}}`.
 */
class m210204_103812_create_provider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%provider}}', [
            'id' => $this->primaryKey(),
            'codeProvider' => $this->string(128)->notNull(),
            'name'=>$this->string(128)->notNull(),
            'tel'=>$this->string(32),
            'email'=>$this->string(120),
            'address'=>$this->string(512),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%provider}}');
    }
}
