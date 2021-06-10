<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210204_101443_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'article' => $this->string(1024)->notNull(),
            'idCatalog'=>$this->integer()->notNull(),
            'idCatalogChild'=>$this->integer(),
            'idBrand'=>$this->integer(),
            'name'=>$this->string(64)->notNull(),
            'price'=>$this->bigInteger()->notNull(),
            'purchasePrice'=>$this->bigInteger(),
            'description'=>$this->string(4096),
            'property'=>$this->string(4096),
            'img'=>$this->string(1024)->notNull(),
            'status'=>$this->integer()->notNull(),
            'count'=>$this->integer(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
