<?php

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $address
 * @property string|null $tel
 * @property string $role
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property int $status
 * @property string|null $last_ip
 * @property string|null $ip_create
 * @property int|null $banned_at
 * @property string|null $banned_reason
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_BLOCKED = 3;
    const STATUS_MODERATE = 5;
    const STATUS_ACTIVE = 10;

    const EMAIL_RESET_PASS = ['type'=>1,'layout'=>'email_reset_pass','url'=>'site/password-confirm','text'=>'Изменение пароля Pechirus'];
    const EMAIL_RESET_EMAIL = ['type'=>2,'layout'=>'email_reset_email','url'=>'site/confirm','text'=>'Подтвердите новую почту Pechirus'];
    const EMAIL_CONFIRM_USER = ['type'=>3,'layout'=>'confirm-user-html','url'=>'site/confirm','text'=>'Подтверждение аккаунта Pechirus'];
    const EMAIL_CONFIRM_ORDER_USER = ['type'=>4,'layout'=>'email_confirm_order_user','url'=>'site/confirm','text'=>'Подтверждение аккаунта Pechirus'];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
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
            [['username', 'email', 'role', 'auth_key', 'password_hash'], 'required'],
            [['status', 'banned_at'], 'integer'],
            [['email'], 'string', 'max' => 78],
            [['name', 'auth_key'], 'string', 'max' => 32],
            [['surname'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 500],
            [['username'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 20],
            [['role'], 'string', 'max' => 10],
            [['password_hash', 'password_reset_token', 'last_ip', 'ip_create'], 'string', 'max' => 255],
            [['banned_reason'], 'string', 'max' => 1000],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['tel'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_MODERATE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE,self::STATUS_MODERATE,self::STATUS_BLOCKED, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Логин'),
            'email' => Yii::t('app', 'Email'),
            'name' => Yii::t('app', 'Имя'),
            'surname' => Yii::t('app', 'Фамилия'),
            'address' => Yii::t('app', 'Адрес'),
            'tel' => Yii::t('app', 'Телефон'),
            'role' => Yii::t('app', 'Роль'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'status' => Yii::t('app', 'Статус'),
            'last_ip' => Yii::t('app', 'Последний IP'),
            'ip_create' => Yii::t('app', 'IP Создания'),
            'banned_at' => Yii::t('app', 'Дата блокировки'),
            'banned_reason' => Yii::t('app', 'Причина блокировки'),
            'created_at' => Yii::t('app', 'Создан в'),
            'updated_at' => Yii::t('app', 'Обновлен в'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert) and !$insert) {
            $dirty = $this->getDirtyAttributes();
            if(isset($dirty['email'])){
                $this->status = self::STATUS_MODERATE;
                $this->generateAuthKey();
                $this->sendEmail(self::EMAIL_RESET_EMAIL,$dirty['email'],$this->auth_key);
                Yii::$app->session->setFlash('success','Ваша почта успешно изменена, для ее подтверждения мы отправили вам электронное письмо.');
            }elseif (isset($dirty['password_reset_token'])){
                $this->sendEmail(self::EMAIL_RESET_PASS,$this->email,$dirty['password_reset_token']);
                Yii::$app->session->setFlash('success','На вашу почту отправлено письмо для изменения пароля.');
            }
        }
        return true;
    }

    public function afterSave($insert,$changedAttributes)
    {
        if ($insert) {
            ($t = new Log(['type_id' => $this->id,'type' => Log::TYPE_USER,'action' => Log::ACTION_CREATE,'info' => json_encode((array)$this->attributes,JSON_UNESCAPED_UNICODE)]))->save();
            if(Yii::$app->session->has('basket')){
                $basket = Yii::$app->session->get('basket');
                foreach ($basket as $back){
                    $new_basket = new Basket();
                    $new_basket->idUser = $this->id;
                    $new_basket->idProduct = $back['idProduct'];
                    $new_basket->count  = $back['count'];
                    $new_basket->save();
                }
            }
            if(Yii::$app->session->has('wishlist')){
                $basket = Yii::$app->session->get('wishlist');
                foreach ($basket as $back){
                    $new_basket = new Wishlist();
                    $new_basket->idUser = $this->id;
                    $new_basket->idProduct = $back['idProduct'];
                    $new_basket->save();
                }
            }
            if(Yii::$app->session->has('compare')){
                $basket = Yii::$app->session->get('compare');
                foreach ($basket as $back){
                    $new_basket = new Compare();
                    $new_basket->idUser = $this->id;
                    $new_basket->idProduct = $back['idProduct'];
                    $new_basket->save();
                }
            }
        } else {
            (new Log(['type_id' => $this->id,'type' => Log::TYPE_USER,'action' => Log::ACTION_UPDATE,'info' => json_encode((array)$changedAttributes,JSON_UNESCAPED_UNICODE)]))->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function sendEmail($type,$email,$key,$pass=null,$login=null){
        $body = Yii::$app->view->renderFile ( '@app/mail/layouts/'.$type['layout'].'.php' , !isset($pass)?[
            'url'=>Url::toRoute([$type['url'],'type'=>$type['type'],'key'=>$key],true)
        ]:[
            'url'=>Url::toRoute([$type['url'],'type'=>$type['type'],'key'=>$key],true),
            'pass' => $pass,
            'login' => $login
        ]);
        //Yii::$app->mailer->htmlLayout = "layouts/".$type['layout'];
        Yii::$app->mailer->compose()//"layouts/".'confirm-user-html.php'
            ->setFrom(['info@pechirus.ru' => 'Письмо с сайта Pechirus']) //TODO EDIT WITH NEW EMAIL
            ->setTo($email)
            ->setSubject($type['text'])
            ->setHtmlBody($body)
            ->send();
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
    public static function findIdentityByAccessToken($token, $type = null) {

        return static::findOne(['auth_key' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findByTel($tel)
    {
        return static::findOne(['tel' => $tel]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public static function getStatusDescription($status)
    {
        if($status == self::STATUS_BLOCKED){
            return 'Заблокирован';
        }elseif($status == self::STATUS_DELETED){
            return 'Удален';
        }elseif($status == self::STATUS_MODERATE){
            return 'Верифицируется';
        }elseif($status == self::STATUS_ACTIVE){
            return 'Активен';
        }
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }



    //ВОССТАНОВЛЕНИЕ ПАРОЛЯ

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {

        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
