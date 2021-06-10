<?php


namespace app\models;

use Yii;
use yii\base\Model;


class ChangePassword extends Model
{
    public $old_password;
    public $new_password;
    public $repeat_password;


    const SCENARIO_RESET = 1;
    const SCENARIO_EMAIL_RESET = 2;

    public function scenarios()
    {
        return [
            self::SCENARIO_RESET => ['old_password','new_password', 'repeat_password'],
            self::SCENARIO_EMAIL_RESET => ['new_password', 'repeat_password'],
        ];
    }


    public function rules()
    {
        return [
            [['new_password', 'repeat_password'], 'required'],
            ['old_password','required','on' => self::SCENARIO_RESET],
            [['new_password', 'repeat_password'], 'trim'],
            ['old_password','trim','on' => self::SCENARIO_RESET],
            ['old_password', 'findPasswords','on' => self::SCENARIO_RESET],
            [['new_password'], 'string', 'min' => 6],
            ['repeat_password', 'compare', 'compareAttribute'=>'new_password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'old_password' => Yii::t('app', 'Текущий пароль'),
            'new_password' => Yii::t('app', 'Новый пароль'),
            'repeat_password' => Yii::t('app', 'Повторите пароль'),
        ];
    }

    //matching the old password with your existing password.
    public function findPasswords($attribute, $params)
    {
        $user = User::findIdentity(Yii::$app->user->id);
        if (!$user || !$user->validatePassword($this->old_password)) {
            $this->addError($attribute, 'Старый пароль указан неверно');
        }
    }

    public function change($id=null){
        if(!$this->validate()){
            return false;
        }
        $user = User::findIdentity($this->scenario==self::SCENARIO_EMAIL_RESET?$id:Yii::$app->user->id);
        $user->setPassword($this->new_password);
        $user->save();
        return $user->save();
    }
}