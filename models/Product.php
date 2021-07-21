<?php

namespace app\models;

use corpsepk\yml\behaviors\YmlOfferBehavior;
use corpsepk\yml\models\Offer;
use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\Sort;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use function Complex\sec;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $article
 * @property int $idCatalog
 * @property int|null $idBrand
 * @property string $name
 * @property int $price
 * @property int|null $purchasePrice
 * @property int $new_price
 * @property string|null $description
 * @property string|null $property
 * @property string $img
 * @property int $status
 * @property int|null $count
 * @property boolean|null $in_stock
 * @property boolean|null $hidden
 * @property int $created_at
 * @property int $updated_at
 */
class Product extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_DEFAULT = 1;
    const STATUS_POPULAR = 2;
    const STATUS_ON_MAIN = 3;

    const STATUS_DESCRIPTION =[self::STATUS_POPULAR=>'Популярный',self::STATUS_ON_MAIN=>'На главной',self::STATUS_DEFAULT=>'Стандартный',self::STATUS_DELETED=>'Удален'];


    public function getJsonStatus(){
        $json = [];
        foreach (self::STATUS_DESCRIPTION as $index=>$status){
            array_push($json,['value'=>$index,'text'=>$status]);
        }
        return json_encode($json,JSON_UNESCAPED_UNICODE);
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function find(): ActiveQuery
    {
        return parent::find()->where(['!=','product.status',0]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var ActiveQuery $model */
                    $model->select(['id', 'product.updated_at']);
                    $model->andWhere(['product.hidden' => 0]);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => Url::toRoute(['/site/product','id'=>$model->id],true),
                        'lastmod' => $model->updated_at,
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.9
                    ];
                }
            ],
            'ymlOffer' => [
                'class' => YmlOfferBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->andWhere(['hidden' => 0]);
                    $model->andWhere(['hidden' => 0]);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return new Offer([
                        'id' => $model->article,
                        'url' => Url::toRoute(['/site/product','id'=>$model->id],true),
                        'price' => $model->price,
                        'available' => true,
                        'store' => $model->in_stock?true:false,
                        'pickup' => $model->in_stock?true:false,
                        'delivery' => true,
                        'currencyId' => 'RUB',
                        'categoryId' => $model->getYandexCategory(),
                        'picture' => ArrayHelper::map(json_decode($model->img,true), 'id', function ($image) {
                            return Url::to('@web/'.$image['path'],true);
                        }),
                        'name' => $model->name,
                        'vendor' => $model->idBrand ? $model->getBrandName() : null,
                        'typePrefix'=>$model->getYandexTypePrefix(),
                        'model'=>$model->getYandexModel(),
                        'description' => strip_tags($model->description),
                        'param' => $model->getYandexParam(),
                        /*'customElements' => [
                            [
                                'outlets' => '<outlet id="1" instock="30" />'
                            ]
                        ],*/
                    ]);
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article', 'idCatalog', 'name', 'price', 'img','status'], 'required'],
            [['idCatalog', 'idBrand', 'price', 'purchasePrice','new_price', 'status', 'count'], 'integer'],
            [['article'], 'string', 'max' => 1024],
            [['name'], 'string', 'max' => 512],
            [['property'], 'string', 'max' => 4096],
            [['description','img'], 'string', 'max' => 65535],
            [['in_stock','hidden'],'boolean'],
            [['hidden'],'default','value' => false],
            [['in_stock'],'default','value' => true],
            ['status', 'default', 'value' => self::STATUS_ON_MAIN],
            ['status', 'in', 'range' => [self::STATUS_POPULAR,self::STATUS_ON_MAIN, self::STATUS_DEFAULT, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'article' => Yii::t('app', 'Артикул'),
            'idCatalog' => Yii::t('app', 'Каталог'),
            'idBrand' => Yii::t('app', 'Брэнд'),
            'name' => Yii::t('app', 'Наименование'),
            'price' => Yii::t('app', 'Цена'),
            'purchasePrice' => Yii::t('app', 'Цена закупки'),
            'new_price' => Yii::t('app', 'Цена по скидке'),
            'description' => Yii::t('app', 'Описание'),
            'property' => Yii::t('app', 'Характеристики'),
            'img' => Yii::t('app', 'Изображения'),
            'status' => Yii::t('app', 'Статус'),
            'count' => Yii::t('app', 'Количество'),
            'in_stock' => Yii::t('app', 'В наличии'),
            'hidden' => Yii::t('app', 'Скрыт'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата последнего обновления'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);//, ['or', ['status' => self::STATUS_ACTIVE], ['status' => self::STATUS_MODERATE]]
    }

    /**
     * @inheritdoc
     */
    public static function findArticle($article)
    {
        return static::findOne(['article' => $article]);//, ['or', ['status' => self::STATUS_ACTIVE], ['status' => self::STATUS_MODERATE]]
    }

    public static function findPopular($name=null,$limit=11)
    {
        $req = static::find()
            ->where(['hidden'=>0])->andWhere(['in_stock'=>1])
            ->joinWith('stat');

        if(isset($name))
            $req = $req->joinWith('catalog')->where('lower(catalog.name) LIKE lower(\'%'.$name.'%\')');

        $req = $req->orderBy(['yandex_product_stat.clicks'=>SORT_DESC]);
        if(isset($limit))
            $req = $req->limit(11);

        return $req->all();
    }

    public function getStatus(){
        return self::STATUS_DESCRIPTION;
    }

    public function getStatusActive(){
        return self::STATUS_DESCRIPTION[$this->status];
    }

    public function getComments(){
        return $this->hasMany(Comments::className(), ['idProduct' => 'id']);
    }

    public function getCatalog(){
        return $this->hasOne(Catalog::className(), ['id' => 'idCatalog']);
    }

    public function getStat(){
        return $this->hasOne(YandexProductStat::className(), ['idProduct' => 'id']);
    }

    public function getRaiting(){
        $rows = (new \yii\db\Query())
            ->select(['AVG(rating) avg'])
            ->from('comments')
            ->where(['idProduct' => $this->id])
            ->one();
        return $rows['avg'];
    }

    public function getCount($type=null){
        if($type=='orders'){
            $rows = (new \yii\db\Query())
                ->select(["SUM(JSON_LENGTH(JSON_SEARCH(productInfo, 'all', ".$this->id."))) cnt"])
                ->from('orders')
                ->one();
        }else{
            $rows = (new \yii\db\Query())
                ->select(['COUNT(*) cnt'])
                ->from($type?$type:'comments')
                ->where([($type?'`'.$type.'`.':'`comments`.').'idProduct' => $this->id])
                ->one();
        }
        return $rows['cnt']?$rows['cnt']:0;
    }

    public function getBrandName(){
        $rows = (new \yii\db\Query())
            ->select(['name'])
            ->from('brand')
            ->where(['id' => $this->idBrand])
            ->one();
        return isset($rows['name'])?$rows['name']:null;
    }

    public function getCatalogName(){
        $rows = (new \yii\db\Query())
            ->select(['name'])
            ->from('catalog')
            ->where(['id' => $this->idCatalog])
            ->one();
        return $rows['name']?$rows['name']:null;
    }
    public function getYandexParam(){
        $params = $this->property;
        if($params){
            $new_param = [];
            $params = json_decode($this->property,true);
            if(isset($params['myrows'])){
                foreach ($params['myrows'] as $param){
                    $new_param[] = $param;
                }
                return $new_param;
            }
        }
        return null;
    }

    public function getYandexCategory(){
        return YandexCategoryToCatalog::getYandexCategoryId($this->idCatalog);
    }

    public function getYandexModel(){
        $brand_name = $this->getBrandName();
        $new_name = preg_replace('/'.$brand_name.'/', '', $this->name);
        if($new_name){
            return $new_name;
        }
        return $this->name;
    }

    public function getYandexTypePrefix(){
        $brand_name = $this->getBrandName();
        $catalog_name = $this->getCatalogName();
        $new_name = preg_replace('/'.$brand_name.'/', '', $catalog_name);
        if($new_name){
            $new_name_1 = '';
            $temp_arr = explode(' ',$this->name);
            $new_name_1 .= $temp_arr[0];
            for ($i = 1; $i < count($temp_arr); $i++){
                if (in_array(mb_substr($temp_arr[$i-1], -2),['ая','яя','ое','ее','ие','ые','ой','ий','ый'])){
                    $new_name_1 .=  (' '.$temp_arr[$i]);
                }else{
                    break;
                }
            }
            return $new_name_1!==''?$new_name_1:$new_name;
        }

        return $catalog_name;
    }

    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_PRODUCT,'action' => Log::ACTION_CREATE,'info' => json_encode((array)$this->attributes,JSON_UNESCAPED_UNICODE)]))->save();
        } else {
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_PRODUCT,'action' => Log::ACTION_UPDATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }
    }
}
