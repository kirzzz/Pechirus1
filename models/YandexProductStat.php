<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yandex_product_stat".
 *
 * @property int|null $idProduct
 * @property int|null $clicks
 * @property float|null $spending
 * @property int|null $feedId
 * @property int|null $offerId
 *
 * @property Product $idProduct0
 */
class YandexProductStat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yandex_product_stat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProduct', 'clicks', 'feedId', 'offerId'], 'integer'],
            [['spending'], 'number'],
            [['idProduct'], 'unique'],
            [['idProduct'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['idProduct' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProduct' => 'Id Product',
            'clicks' => 'Clicks',
            'spending' => 'Spending',
            'feedId' => 'Feed ID',
            'offerId' => 'Offer ID',
        ];
    }

    /**
     * Gets query for [[IdProduct0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'idProduct']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdProduct($id)
    {
        return static::findOne(['idProduct' => $id]);
    }
}
