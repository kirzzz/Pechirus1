<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "compare".
 *
 * @property int $id
 * @property int $idProduct
 * @property int $idUser
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Wishlist extends \yii\db\ActiveRecord
{
    const STATUS_FINISHED = 2;
    const STATUS_ADD = 1;
    const STATUS_REMOVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishlist';
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
            [['idProduct', 'idUser'], 'required'],
            [['idProduct', 'idUser', 'status'], 'integer'],
            ['status','default','value' => self::STATUS_ADD],
            ['status','in','range' => [self::STATUS_ADD,self::STATUS_REMOVE,self::STATUS_FINISHED]]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idProduct' => Yii::t('app', 'Id Продукта'),
            'idUser' => Yii::t('app', 'Id Пользователя'),
            'status' => Yii::t('app', 'Статус'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата последнего обновления'),
        ];
    }


    public function afterSave($insert,$changedAttributes)
    {
        if ($insert) {
            ($t = new Log(['type_id' => $this->id,'type' => Log::TYPE_WISHLIST,'action' => Log::ACTION_CREATE,'info' => json_encode((array)$this->attributes,JSON_UNESCAPED_UNICODE)]))->save();
        } else {
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_WISHLIST,'action' => Log::ACTION_UPDATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
