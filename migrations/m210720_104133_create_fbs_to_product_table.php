<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fbs_to_product}}`.
 */
class m210720_104133_create_fbs_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fbs_to_product}}', [
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
        $this->dropTable('{{%fbs_to_product}}');
    }
}
