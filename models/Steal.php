<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "steal".
 *
 * @property int $id
 * @property string|null $siteName
 * @property int|null $idProduct
 * @property int|null $offerId
 * @property string|null $vendorCode
 * @property string|null $url
 * @property int|null $price
 * @property int|null $oldPrice
 * @property string|null $currency
 * @property int|null $categoryId
 * @property string|null $pictures
 * @property string|null $description
 * @property string|null $parameters
 * @property string|null $name
 */
class Steal extends \yii\db\ActiveRecord
{
    const ID_PRODUCT = -1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'steal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProduct', 'offerId', 'price', 'oldPrice', 'categoryId'], 'integer'],
            [['pictures', 'description', 'parameters'], 'string'],
            [['siteName'], 'string', 'max' => 128],
            [['vendorCode'], 'string', 'max' => 64],
            [['url', 'name'], 'string', 'max' => 512],
            [['currency'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'siteName' => 'Представитель',
            'idProduct' => 'Id Продукта',
            'offerId' => 'Артикул',
            'vendorCode' => 'Код производителя',
            'url' => 'Url',
            'price' => 'Цена',
            'oldPrice' => 'Старая Цена',
            'currency' => 'Валюта',
            'categoryId' => 'Категория',
            'pictures' => 'Изображение',
            'description' => 'Описание',
            'parameters' => 'Параметры',
            'name' => 'Наименование',
        ];
    }
}
