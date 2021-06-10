<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210207_134029_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username'=> $this->string(100)->notNull()->unique(),
            'email' => $this->string(78)->notNull()->unique(),
            'name' => $this->string(32),
            'surname' => $this->string(64),
            'address'=>$this->string(500),
            'tel' => $this->string(20)->unique(),
            'role' => $this->string(10)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'last_ip' => $this->string(),
            'ip_create' => $this->string(),
            'banned_at' => $this->integer(),
            'banned_reason' => $this->string(1000),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
