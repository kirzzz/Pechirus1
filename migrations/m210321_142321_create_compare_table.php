<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%compare}}`.
 */
class m210321_142321_create_compare_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%compare}}', [
            'id' => $this->primaryKey(),
            'idProduct' => $this->integer()->notNull(),
            'idUser' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%compare}}');
    }
}
