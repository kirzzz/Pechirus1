<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m210316_211938_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(64)->notNull(),
            'status' => $this->boolean()->defaultValue(true),
            'info' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log}}');
    }
}
