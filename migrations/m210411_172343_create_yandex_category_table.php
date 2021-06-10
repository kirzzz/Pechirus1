<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%yandex_category}}`.
 */
class m210411_172343_create_yandex_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%yandex_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128),
            'idParent' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%yandex_category}}');
    }
}
