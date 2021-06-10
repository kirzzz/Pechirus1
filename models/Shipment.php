<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shipment".
 *
 * @property int $id
 * @property string $codeShipment
 * @property string $codeProvider
 * @property string $products
 * @property int $created_at
 * @property int $updated_at
 */
class Shipment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shipment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codeShipment', 'codeProvider', 'products', 'created_at', 'updated_at'], 'required'],
            [['products'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['codeShipment', 'codeProvider'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codeShipment' => Yii::t('app', 'Код поставки'),
            'codeProvider' => Yii::t('app', 'Код поставщика'),
            'products' => Yii::t('app', 'Продукты'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата последнего обновления'),
        ];
    }
}
