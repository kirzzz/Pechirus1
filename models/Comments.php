<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $idUser
 * @property int $idProduct
 * @property int|null $childId
 * @property int $rating
 * @property string $text
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $name
 * @property string $email
 */
class Comments extends \yii\db\ActiveRecord
{
    const STATUS_DELETE = 0;
    const STATUS_CONSIDERATION = 1;
    const STATUS_ACTIVE = 2;

    const SCENARIO_AUTHORIZED = 2;
    const SCENARIO_NOT_AUTHORIZED = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProduct', 'rating', 'text','name'], 'required'],
            [['idUser'], 'required' , 'on' => self::SCENARIO_AUTHORIZED ],
            [['email'], 'required' , 'on' => self::SCENARIO_NOT_AUTHORIZED ],
            [['name'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 64],
            [['idProduct', 'childId', 'rating', 'status'], 'integer'],
            [['text'], 'string', 'max' => 1024],
            ['status', 'default', 'value' => self::STATUS_CONSIDERATION],
            ['status', 'in', 'range' => [
                self::STATUS_CONSIDERATION,
                self::STATUS_DELETE,
                self::STATUS_ACTIVE,
            ]],
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
            'idUser' => Yii::t('app', 'Id Пользователя'),
            'idProduct' => Yii::t('app', 'Id Продукта'),
            'name' => Yii::t('app', 'Ваше имя'),
            'email' => Yii::t('app', 'Ваша почта'),
            'childId' => Yii::t('app', 'Ответ на ID'),
            'rating' => Yii::t('app', 'Рэйтинг'),
            'text' => Yii::t('app', 'Ваш отзыв'),
            'status' => Yii::t('app', 'Статус'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата последнего обновления'),
        ];
    }

    public function afterSave($insert,$changedAttributes)
    {
        if(!$insert){
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_COMMENTS,'action' => Log::ACTION_UPDATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }else{
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_COMMENTS,'action' => Log::ACTION_CREATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function getName($id=null){
        $data = Comments::find()->where(['id'=>$id?$id:$this->id])->with('user')->one();
        return $data['name'];
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
