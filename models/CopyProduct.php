<?php


namespace app\models;


use Yii;
use yii\base\Model;

class CopyProduct extends Model
{
    public $steal_id;
    public $price;
    public $in_stock;
    public $hidden;
    public $id_catalog;
    public $id_brand;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_catalog', 'price'], 'required'],
            [['id_catalog', 'id_brand', 'price', 'steal_id'], 'integer'],
            [['in_stock','hidden'],'boolean'],
            [['hidden','in_stock'],'default','value' => true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'price' => Yii::t('app', 'Цена'),
            'in_stock' => Yii::t('app', 'В наличии'),
            'hidden' => Yii::t('app', 'Скрыт'),
            'id_catalog' => Yii::t('app', 'Каталог'),
            'id_brand' => Yii::t('app', 'Производитель'),
        ];
    }
    public function addProductImage($url,$article){
        $contents = file_get_contents($url);
        if($contents !== false) {
            if(mkdir(Yii::$app->basePath.'/web/images/'.$article.'/')){
                $name = Yii::$app->basePath.'/web/images/'.$article.'/'. basename($url);
                file_put_contents($name, $contents);
                return ['name'=>basename($url),'path'=>'images/'.$article.'/'. basename($url),'size'=>filesize($name)];
            }
        }
        return false;
    }

    public function addProduct(){
        $steal = Steal::find()->where(['id'=>$this->steal_id])->one();
        $product = new Product();
        $article = (new \yii\db\Query())->from('product')->max('article') + 1;
        $product->article = $article;
        $product->idCatalog = $this->id_catalog;
        $product->idBrand = $this->id_brand;
        $product->name = $steal->name;
        $product->price = $this->price;
        $steal_property = json_decode($steal->parameters,true);
        foreach ($steal_property as $index=>$row){
            if(!isset($row['name']))
                unset($steal_property[$index]);
        }
        $product->property = json_encode(["myrows" =>$steal_property],JSON_UNESCAPED_UNICODE);;
        $product->description = $steal->description;
        $product->hidden = $this->hidden;
        $product->in_stock = $this->in_stock;
        $product->count = 999;
        $product->status = Product::STATUS_DEFAULT;

        $images = json_decode($steal->pictures,true);
        $product_imgs = [];
        if(!empty($images)){
            foreach ($images as $img){
                if(($filename = static::addProductImage($img,$article)) !== false){
                    $product_imgs[] = $filename;
                }
            }
        }
        if($product->save()){
            return $product->id;
        }
        SetError::setErrorST($product,'');
        return false;
    }
}