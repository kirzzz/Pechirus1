<?php

namespace app\models;

use corpsepk\yml\behaviors\YmlCategoryBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "yandex_category".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $idParent
 * @property int|null $idCatalog
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class YandexCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yandex_category';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'ymlCategory' => [
                'class' => YmlCategoryBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['id', 'name', 'idParent']);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'id' => $model->id,
                        'name' => $model->name,
                        'parentId' => $model->idParent
                    ];
                }
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idParent', 'idCatalog'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'idParent' => 'Id Parent',
            'idCatalog' => 'Id Catalog',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
