<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yandex_category_to_catalog".
 *
 * @property int $id
 * @property int|null $id_category
 * @property int|null $id_catalog
 */
class YandexCategoryToCatalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yandex_category_to_catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_category', 'id_catalog'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_category' => 'Id Category',
            'id_catalog' => 'Id Catalog',
        ];
    }

    public static function getYandexCategoryId($idCatalog){
        $relation = static::findOne(['id_catalog'=>$idCatalog]);
        if( isset($relation->id_category))
            return (static::findOne(['id_catalog'=>$idCatalog]))->id_category;
        return (YandexCategory::findOne(['idParent'=>null]))->id;
    }
}
