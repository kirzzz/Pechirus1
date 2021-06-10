<?php

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "compare".
 *
 * @property int $id
 * @property string $name
 * @property string $json
 * @property int $created_at
 * @property int $updated_at
 */
class Yandex extends \yii\db\ActiveRecord
{
    const STAT_OFFER = 'OffersStat';
    const STAT_BASE = 'BaseStat';

    const QUALITY_REPORT = 'QualityClientReport';
    const QUALITY_ERROR = 'QualityClientError';

    const FEEDBACK = 'Feedback';

    const BALANCE = 'Balance';

    const BIDS_INFO = 'BidsInfo';
    const BIDS_RECOMMENDED = 'BidsRecommended';
    const BIDS_RECOMMENDED_MARKET = 'BidsRecommendedMarket';
    const BIDS_SETTINGS = 'BidsSettings';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yandex';
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
            [['name','json'], 'required'],
            ['json','string','max' => 4294967295]
        ];
    }

    public static function getOffersStat(){
        $data = Yandex::find()->where(['name'=>self::STAT_OFFER])->orderBy(['created_at'=>SORT_DESC])->one();
        $data = json_decode($data['json'],true);
        return $data;
    }

    public static function getBaseStat(){
        $data = Yandex::find()->where(['name'=>self::STAT_BASE])->orderBy(['created_at'=>SORT_DESC])->one();
        $data = json_decode($data['json'],true);
        return $data;
    }
}
