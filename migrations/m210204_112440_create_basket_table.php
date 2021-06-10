<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%basket}}`.
 */
class m210204_112440_create_basket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%basket}}', [
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
        $this->dropTable('{{%basket}}');
    }
}
