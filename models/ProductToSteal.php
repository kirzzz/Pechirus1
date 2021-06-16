<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_to_steal".
 *
 * @property int $id
 * @property int|null $id_product
 * @property int|null $id_steal
 * @property int|null $status
 * @property int|null $rateName
 * @property int|null $rateNameNumbers
 * @property int|null $rateDescription
 * @property int|null $rateProperty
 */
class ProductToSteal extends \yii\db\ActiveRecord
{
    const STATUS_REJECTED = -1;
    const STATUS_NO_SOLUTION = 0;
    const STATUS_ACCEPT = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_to_steal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_product', 'id_steal', 'status', 'rateName', 'rateNameNumbers', 'rateDescription', 'rateProperty'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_REJECTED,self::STATUS_NO_SOLUTION, self::STATUS_ACCEPT]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Продукта',
            'id_steal' => 'Id Предложения',
            'status' => 'Статус',
            'rateName' => 'Коэффициент соответстия названий',
            'rateNameNumbers' => 'Соответствие цифр в названиях',
            'rateDescription' => 'Коэффициент соответстия описаний',
            'rateProperty' => 'Коэффициент соответстия параметров',
        ];
    }

    public function getProduct(){
        return $this->hasOne(Product::className(), ['id' => 'id_product']);
    }

    public function getSteal(){
        return $this->hasOne(Steal::className(), ['offerId' => 'id_steal']);
    }
}
