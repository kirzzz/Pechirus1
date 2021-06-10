<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%yandex_base_stat}}`.
 */
class m210407_153017_create_yandex_base_stat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%yandex_base_stat}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull()->unique(),
            'clicks' => $this->integer()->notNull(),
            'placeGroup' => $this->integer(),
            'spending' => $this->decimal(6,2),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%yandex_base_stat}}');
    }
}
