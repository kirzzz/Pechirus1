<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property string $type
 * @property string $type_id
 * @property string $action
 * @property int|null $status
 * @property string|null $info
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Log extends \yii\db\ActiveRecord
{
    CONST TYPE_BASKET = 'Basket';
    CONST TYPE_BRAND = 'Brand';
    CONST TYPE_CATALOG = 'Catalog';
    CONST TYPE_COMMENTS = 'Comments';
    CONST TYPE_CONTACT = 'Contact';
    CONST TYPE_ORDERS = 'Orders';
    CONST TYPE_PRODUCT = 'Product';
    CONST TYPE_USER = 'User';
    CONST TYPE_COMPARE= 'Compare';
    CONST TYPE_WISHLIST= 'Wishlist';
    CONST TYPE_ERROR= 'ERROR';

    CONST ACTION_CREATE = 'create';
    CONST ACTION_UPDATE = 'update';
    CONST ACTION_DELETE = 'delete';
    CONST ACTION_ERROR = 'error';

    const TYPE_DESCRIPTION =[
        self::TYPE_BASKET => 'Корзина',
        self::TYPE_BRAND => 'Брэнд',
        self::TYPE_CATALOG => 'Каталог',
        self::TYPE_COMMENTS => 'Комментарий',
        self::TYPE_CONTACT => 'Контакт',
        self::TYPE_ORDERS => 'Заказ',
        self::TYPE_PRODUCT => 'Продукт',
        self::TYPE_USER => 'Пользователь',
        self::TYPE_COMPARE => 'Сравнение',
        self::TYPE_WISHLIST => 'Понравившиеся',
        self::TYPE_ERROR => 'Error'
    ];

    const ACTION_DESCRIPTION =[
        self::ACTION_CREATE => 'Создан новый',
        self::ACTION_UPDATE => 'Обновлен',
        self::ACTION_DELETE => 'Удален',
        self::ACTION_ERROR => 'Ошибка',
    ];

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
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type','action'], 'required'],
            [['status','type_id'], 'integer'],
            [['info'], 'string'],
            [['type'], 'string', 'max' => 64],
            [['action'], 'string', 'max' => 32],
            ['status','default','value' => 1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Операция'),
            'action' => Yii::t('app', 'Действие'),
            'status' => Yii::t('app', 'Статус'),
            'info' => Yii::t('app', 'Информация'),
            'created_at' => Yii::t('app', 'Создано в:'),
            'updated_at' => Yii::t('app', 'Обновлено в:'),
        ];
    }
}
