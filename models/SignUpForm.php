<?php


namespace app\models;

use app\models\User;
use yii\helpers\Url;
use yii\base\Model;
use Yii;

class SignUpForm extends Model
{
    public $username;
    public $email;
    public $password;

    const SIGN_ORDER = 1;
    const SIGN_NORMAL = 2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Логин'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Пароль'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($type)
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->role = 'user';
            $user->ip_create = Yii::$app->request->userIP;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            if($type == self::SIGN_ORDER){
                $user->sendEmail($user::EMAIL_CONFIRM_ORDER_USER,$user->email,$user->auth_key,$this->password,$this->username);
            }elseif($type == self::SIGN_NORMAL){
                $user->sendEmail($user::EMAIL_CONFIRM_USER,$user->email,$user->auth_key);
            }
            return $user->save()?$user:null;
        }

        return null;
    }
}