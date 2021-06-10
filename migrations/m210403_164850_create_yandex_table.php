<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%yandex}}`.
 */
class m210403_164850_create_yandex_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%yandex}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'json' => $this->text(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%yandex}}');
    }
}
