<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "avito_to_product".
 *
 * @property int $id
 * @property int $id_product
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class AvitoToProduct extends \yii\db\ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE= 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avito_to_product';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_product'], 'required'],
            [['id_product', 'status', 'created_at', 'updated_at'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [
                self::STATUS_ACTIVE,
                self::STATUS_PASSIVE
            ]]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findByIdProduct($id) {
        return static::findOne(['id_product' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function isProductIsset($id) {
        $temp =  static::findOne(['id_product' => $id]);
        return isset($temp->id);
    }

    /**
     * @inheritdoc
     */
    public static function isProductActive($id) {
        $temp =  static::findOne(['id_product' => $id, 'status'=>static::STATUS_ACTIVE]);
        return isset($temp->id);
    }

    /**
     * @inheritdoc
     */
    public static function isProductPassive($id) {
        $temp =  static::findOne(['id_product' => $id, 'status'=>static::STATUS_PASSIVE]);
        return isset($temp->id);
    }

    /**
     * @inheritdoc
     */
    public static function getActiveId() {
        $temp =  static::findAll(['status'=>static::STATUS_ACTIVE]);
        return array_column($temp,'id_product');
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
