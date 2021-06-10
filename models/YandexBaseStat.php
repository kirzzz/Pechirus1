<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yandex_base_stat".
 *
 * @property int $id
 * @property string $date
 * @property int $clicks
 * @property int|null $placeGroup
 * @property float|null $spending
 */
class YandexBaseStat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yandex_base_stat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'clicks'], 'required'],
            [['date'], 'safe'],
            [['clicks', 'placeGroup'], 'integer'],
            [['spending'], 'number'],
            [['date'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'clicks' => 'Clicks',
            'placeGroup' => 'Place Group',
            'spending' => 'Spending',
        ];
    }

    public static function findDate($date){
        return static::findOne(['date' => $date]);
    }
}
