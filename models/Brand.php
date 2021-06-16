<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $img
 * @property int $created_at
 * @property int $updated_at
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand';
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['img'], 'string', 'max' => 1024],
            [['description'], 'string', 'max' => 65535],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Наименование'),
            'description' => Yii::t('app', 'Описание'),
            'img' => Yii::t('app', 'Изображение'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата последнего обновления'),
        ];
    }

    public function afterSave($insert,$changedAttributes)
    {
        if (!$insert) {
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_BRAND,'action' => Log::ACTION_UPDATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }else{
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_BRAND,'action' => Log::ACTION_CREATE,'info' => json_encode((array)$this->attributes,JSON_UNESCAPED_UNICODE)]))->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
