<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "provider".
 *
 * @property int $id
 * @property string $codeProvider
 * @property string $name
 * @property string|null $tel
 * @property string|null $email
 * @property string|null $address
 * @property int $created_at
 * @property int $updated_at
 */
class Provider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provider';
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
            [['codeProvider', 'name'], 'required'],
            [['codeProvider', 'name'], 'string', 'max' => 128],
            [['tel'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 120],
            ['email', 'email'],
            [['address'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codeProvider' => Yii::t('app', 'Код Поставщика'),
            'name' => Yii::t('app', 'Наименование'),
            'tel' => Yii::t('app', 'Телефон'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Адресс'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
