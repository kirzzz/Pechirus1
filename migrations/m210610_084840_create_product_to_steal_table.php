<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_to_steal}}`.
 */
class m210610_084840_create_product_to_steal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_to_steal}}', [
            'id' => $this->primaryKey(),
            'id_product' => $this->integer(),
            'id_steal' => $this->integer(),
            'status' => $this->tinyInteger()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_to_steal}}');
    }
}
