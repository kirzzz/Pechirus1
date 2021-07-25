<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%avito_to_product}}`.
 */
class m210721_002600_create_avito_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%avito_to_product}}', [
            'id' => $this->primaryKey(),
            'id_product' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(0),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%avito_to_product}}');
    }
}
