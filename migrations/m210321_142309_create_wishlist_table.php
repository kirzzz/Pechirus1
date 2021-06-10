<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wishlist}}`.
 */
class m210321_142309_create_wishlist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wishlist}}', [
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
        $this->dropTable('{{%wishlist}}');
    }
}
