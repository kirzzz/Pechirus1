<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog}}`.
 */
class m210204_100441_create_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catalog}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(1024)->notNull()->unique(),
            'description'=>$this->string(1024),
            'img'=>$this->string(1024),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%catalog}}');
    }
}
