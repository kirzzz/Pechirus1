<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%yandex_category_to_catalog}}`.
 */
class m210411_182354_create_yandex_category_to_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%yandex_category_to_catalog}}', [
            'id' => $this->primaryKey(),
            'id_category' => $this->integer(),
            'id_catalog' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%yandex_category_to_catalog}}');
    }
}
