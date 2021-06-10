<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shipment}}`.
 */
class m210204_104145_create_shipment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shipment}}', [
            'id' => $this->primaryKey(),
            'codeShipment' => $this->string(128)->notNull(),
            'codeProvider' => $this->string(128)->notNull(),
            'products' => $this->text()->notNull(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shipment}}');
    }
}
