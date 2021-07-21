<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Integer;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $article
 * @property int $idUser
 * @property int $price
 * @property string $address
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string productInfo
 * @property string name
 * @property string surname
 * @property string tel
 * @property string comment
 * @property string postalCode
 * @property int typeOfDelivery
 * @property int regionOfDelivery
 * @property int payment
 */
class Orders extends \yii\db\ActiveRecord
{
    public int $type = 1;

    const STATUS_REJECTED = 0;
    const STATUS_CANCELED = 1;
    const STATUS_UN_CONFIRMED = 4;
    const STATUS_CONSIDERATION = 5;
    const STATUS_CONFIRMED = 6;
    const STATUS_ACTIVE = 7;
    const STATUS_DELIVERED = 8;
    const STATUS_FINISHED = 10;

    const STATUS_DESCRIPTION =[
        self::STATUS_REJECTED => 'Отменен Администратором/Модератором',
        self::STATUS_CANCELED => 'Отменен Пользователем',
        self::STATUS_UN_CONFIRMED => 'Ожидает подтверждения пользователем',
        self::STATUS_CONSIDERATION => 'На рассмотрении',
        self::STATUS_CONFIRMED => 'Подтвержден',
        self::STATUS_ACTIVE => 'Собирается',
        self::STATUS_DELIVERED => 'В пути',
        self::STATUS_FINISHED => 'Доставлен'
    ];

    const STATUS_HTML = [
        self::STATUS_REJECTED => '<span class="badge label-table badge-dark">Отменен Администратором/Модератором</span>',
        self::STATUS_CANCELED => '<span class="badge label-table badge-danger">Отменен Пользователем</span>',
        self::STATUS_UN_CONFIRMED => '<span class="badge label-table badge-info">Ожидает подтверждения пользователем</span>',
        self::STATUS_CONSIDERATION => '<span class="badge label-table badge-secondary">На рассмотрении</span>',
        self::STATUS_CONFIRMED => '<span class="badge label-table badge-success">Подтвержден</span>',
        self::STATUS_ACTIVE => '<span class="badge label-table badge-soft-success">Собирается</span>',
        self::STATUS_DELIVERED => '<span class="badge label-table badge-outline-success">В пути</span>',
        self::STATUS_FINISHED => '<span class="badge label-table badge-light">Доставлен</span>'
    ];

    const TYPE_OF_DELIVERY = [
        ['id'=>1,'name'=>'Самовывоз','data-order-region-show'=>0],
        ['id'=>2,'name'=>'ПЭК','data-order-region-show'=>[5]],
        ['id'=>3,'name'=>'Курьер','data-order-region-show'=>[1,2,3,4]],
        ['id'=>4,'name'=>'Деловые линии','data-order-region-show'=>[5]],
    ];

    const REGION_OF_DELIVERY = [
        ['id'=>1,'name'=>'До МКАД стандартный груз','data-order-region-price'=>700,'data-order-region-date'=>'3 дня'],
        ['id'=>2,'name'=>'До МКАД крупногаборитный груз, договорная цена','data-order-region-price'=>1000,'data-order-region-date'=>'3 дня'],
        ['id'=>3,'name'=>'За МКАД стандартный груз +30 руб/км','data-order-region-price'=>700,'data-order-region-date'=>'3 дня'],
        ['id'=>4,'name'=>'За МКАД крупногаборитный груз, договорная цена +30 руб/км','data-order-region-price'=>1000,'data-order-region-date'=>'3 дня'],
        ['id'=>5,'name'=>'До транспортной компании','data-order-region-price'=>700,'data-order-region-date'=>'1 - 3 дня']
    ];

    const TYPE_OF_PAYMENT = [
        ['id'=>1,'name'=>'Наличными:','name-2'=>'Курьеру или самовывоз'],
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
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
            [['article','idUser', 'price', 'productInfo','name','surname','tel','typeOfDelivery','payment'], 'required'],

            [['idUser', 'price', 'status','payment','typeOfDelivery','regionOfDelivery'], 'integer'],
            [['address','comment'], 'string', 'max' => 512],
            [['name'], 'string', 'max' => 32],
            [['surname','article'], 'string', 'max' => 64],
            [['tel'], 'string', 'max' => 20],
            [['postalCode'], 'string', 'max' => 12],
            [['productInfo'], 'string', 'max' => 65535],

            [['article'], 'unique'],

            ['status', 'default', 'value' => self::STATUS_UN_CONFIRMED],
            ['status', 'in', 'range' => [
                self::STATUS_REJECTED,
                self::STATUS_CANCELED,
                self::STATUS_UN_CONFIRMED,
                self::STATUS_CONSIDERATION,
                self::STATUS_CONFIRMED,
                self::STATUS_ACTIVE,
                self::STATUS_DELIVERED,
                self::STATUS_FINISHED
            ]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'article' => Yii::t('app', 'ID Заказа'),
            'idUser' => Yii::t('app', 'Id Пользователя'),
            'price' => Yii::t('app', 'Цена'),
            'address' => Yii::t('app', 'Адрес'),
            'status' => Yii::t('app', 'Статус'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата последнего обновления'),
            'productInfo' =>Yii::t('app', 'Продукты'),
            'name' =>Yii::t('app', 'Имя'),
            'surname' =>Yii::t('app', 'Фамилия'),
            'tel' =>Yii::t('app', 'Телефон'),
            'comment' =>Yii::t('app', 'Комментарий к заказу'),
            'postalCode' =>Yii::t('app', 'Почтовый индекс'),
            'typeOfDelivery' =>Yii::t('app', 'Тип доставки'),
            'regionOfDelivery'=>Yii::t('app', 'Регион доставки'),
            'payment' =>Yii::t('app', 'Тип платежа'),
        ];
    }

    public function getActiveStatus(){
        return self::STATUS_DESCRIPTION[$this->status];
    }

    public static function generateUniqNumber($x,$y){
        $n = ((($y-1)*($y-2)/2)+$x);
        $kn = (int)abs((sqrt(8*$n+1)-1)/2);
        $hn = $kn + 1;
        $gn = $n - ($kn - 1)*$kn/2;
        return (int)((($gn - 1)*($gn-2)/2)+$hn);
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate() and !isset($this->id)) {
            $this->article = '#'.self::generateUniqNumber(Yii::$app->user->id,time()/100000);
            $this->payment = 1;
            $basket = Basket::find()->where(['idUser'=>Yii::$app->user->id])->andWhere(['status'=>Basket::STATUS_ADD])->all();
            $this->status = self::STATUS_CONSIDERATION;
            $total_price = 0;
            if(!empty($basket)){
                $products = Product::find()->andWhere(['in','id',array_column($basket,'idProduct')])->all();
                foreach ($basket as $back){
                    $total_price += $back['count'] * $products[array_search($back['idProduct'],array_column($products,'id'))]['price'];
                }
                $total_price += array_search($this->regionOfDelivery,array_column(self::REGION_OF_DELIVERY,'id'))!==false?self::REGION_OF_DELIVERY[array_search($this->regionOfDelivery,array_column(Orders::REGION_OF_DELIVERY,'id'))]['data-order-region-price']:0;
                $this->price = $total_price;
            }else{
                $this->addError('price','Ваша корзина пуста.');
                return false;
            }
            $product_info = Basket::find()->where(['idUser'=>Yii::$app->user->id])->andWhere(['status'=>Basket::STATUS_ADD])->asArray()->all();
            foreach ($product_info as $index=>$info){
                $price = Product::find()->select('price,new_price')->andWhere(['id'=>$info['idProduct']])->one();
                $product_info[$index]['price'] = $price->new_price?$price->new_price:$price->price;
                $product_info[$index]['discount'] = $price->new_price?1:0;
            }
            $this->productInfo = json_encode($product_info,JSON_UNESCAPED_UNICODE);
            return parent::beforeValidate(); // TODO: Change the autogenerated stub
        }
    }

    public function afterSave($insert,$changedAttributes)
    {
        if ($insert) {
            ($t = new Log(['type_id' => $this->id,'type' => Log::TYPE_ORDERS,'action' => Log::ACTION_CREATE,'info' => json_encode((array)$this->attributes,JSON_UNESCAPED_UNICODE)]))->save();
            $body = Yii::$app->view->renderFile ( '@app/mail/layouts/email_order.php' , [
                'order'=>Orders::find()->where(['id'=>$this->id])->one()
            ]);
            $user = User::find()->where(['id'=>$this->idUser])->one();
            Yii::$app->mailer->compose()//"layouts/".'confirm-user-html.php'
            ->setFrom(['info@pechirus.ru' => 'Письмо с сайта Pechirus'])
                ->setTo($user->email)
                ->setSubject('Спасибо за заказ!')
                ->setHtmlBody($body)
                ->send();
            $body = Yii::$app->view->renderFile ( '@app/mail/layouts/email_order_notif.php' , [
                'order'=>Orders::find()->where(['id'=>$this->id])->one(),
                'user' => $user
            ]);
            Yii::$app->mailer->compose()
            ->setFrom(['info@pechirus.ru' => 'Новый заказ'])
                ->setTo('pechirus@gmail.com')
                ->setSubject('Спасибо за заказ!')
                ->setHtmlBody($body)
                ->send();
        } else {
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_ORDERS,'action' => Log::ACTION_UPDATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
