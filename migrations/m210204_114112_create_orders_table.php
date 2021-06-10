<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m210204_114112_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'idOrder'=> $this->integer()->notNull(),
            'idProduct' => $this->integer()->notNull(),
            'idUser' => $this->integer()->notNull(),
            'price' => $this->bigInteger()->notNull(),
            'address' => $this->string(512)->notNull(),
            'type' => $this->integer()->notNull(),
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
        $this->dropTable('{{%orders}}');
    }
}
