<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%steal}}`.
 */
class m210610_083325_create_steal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%steal}}', [
            'id' => $this->primaryKey(),
            'siteName' => $this->string(128),
            'idProduct' => $this->integer(),
            'offerId' => $this->integer(),
            'vendorCode' => $this->string(64),
            'url'=>$this->string(512),
            'price'=>$this->integer(),
            'oldPrice'=>$this->integer(),
            'currency'=>$this->string(3),
            'categoryId'=>$this->integer(),
            'pictures'=>$this->text(),
            'description'=>$this->text(),
            'parameters'=>$this->text(),
            'name'=>$this->string(512),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%steal}}');
    }
}
