<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%yandex_to_product}}`.
 */
class m210407_130817_create_yandex_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%yandex_product_stat}}', [
            'idProduct' => $this->integer()->unique(),
            'clicks' => $this->integer(),
            'spending' => $this->decimal(),
            'feedId'=> $this->integer(),
            'offerId'=>$this->integer()
        ]);
        $this->addForeignKey('to_product_id','yandex_product_stat','idProduct','product','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%yandex_to_product}}');
    }
}
