<?php

namespace app\models;

use corpsepk\yml\behaviors\YmlCategoryBehavior;
use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\helpers\Url;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property string $name
 * @property int $idParent
 * @property int $article
 * @property string|null $description
 * @property string|null $img
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Catalog extends ActiveRecord
{

    const STATUS_HIDDEN = 0;
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog';
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
                    $model->select(['id', 'catalog.updated_at']);
                    $model->andWhere(['catalog.status' => self::STATUS_ACTIVE]);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => Url::toRoute(['/site/product','catalog'=>$model->id], true),
                        'lastmod' => $model->updated_at,
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.8
                    ];
                }
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','article'], 'required'],
            [['idParent','article'], 'integer'],
            [['description', 'img','name'], 'string', 'max' => 1024],
            [['article'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE,self::STATUS_HIDDEN]],
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
            'status' => Yii::t('app', 'Статус'),
            'article' => Yii::t('app', 'Артикул'),
            'idParent' => Yii::t('app', 'Родительский артикул'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата последнего обновления'),
        ];
    }

    public function afterSave($insert,$changedAttributes)
    {
        if(!$insert){
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_CATALOG,'action' => Log::ACTION_UPDATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }else{
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_CATALOG,'action' => Log::ACTION_CREATE,'info' => json_encode((array)$this->attributes,JSON_UNESCAPED_UNICODE)]))->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public static function getTreeDown($id){
        $catalog = static::find()->where(['id'=>$id])->one();
        function catalog_add(int $id,int $artice): ?array {
            static $id_arr = [];
            $id_arr[] = $id;
            $temp = Catalog::find()->where(['idParent'=>$artice])->all();
            if(!empty($temp)){
                foreach ($temp as $temp1){
                    catalog_add($temp1['id'],$temp1['article']);
                }
            }
            return $id_arr;
        }
        return catalog_add($catalog->id,$catalog->article);
    }

    public static function getTreeTop($id){
        $catalog = static::find()->where(['id'=>$id])->one();
        function catalog_add_top(int $id,$idParent): ?array {
            static $id_arr = [];
            $id_arr[] = $id;
            $temp = Catalog::find()->where(['article'=>$idParent])->one();
            if(!empty($temp)){
                catalog_add_top($temp->id,$temp->idParent);
            }
            return array_reverse($id_arr);
        }
        return catalog_add_top($catalog->id,$catalog->idParent);
    }
}
