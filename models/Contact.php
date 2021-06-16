<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $tel
 * @property string|null $email
 * @property string $message
 * @property int $created_at
 * @property int $updated_at
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tel', 'message'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['tel'], 'string', 'max' => 21],
            [['email'], 'string', 'max' => 64],
            [['message'], 'string', 'max' => 500],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Имя'),
            'tel' => Yii::t('app', 'Телефон'),
            'email' => Yii::t('app', 'Почта'),
            'message' => Yii::t('app', 'Сообщение'),
            'created_at' => Yii::t('app', 'Создано в'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function afterSave($insert,$changedAttributes)
    {
        if(!$insert){
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_CONTACT,'action' => Log::ACTION_UPDATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }else{
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_CONTACT,'action' => Log::ACTION_CREATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
