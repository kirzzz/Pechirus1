<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Pechirus: Восстановление аккаунта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumb-area bg-theme-color-main breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Восстановление пароля</h2>
            <ul>
                <li><a href="<?= Url::toRoute(['site/index'])?>">Главная</a></li>
                <li><span> > </span></li>
                <li><a href="<?= Url::toRoute(['site/login'])?>"> Войти / Создать аккаунт </a></li>
                <li><span> > </span></li>
                <li class="active"> Восстановление аккаунта </li>
            </ul>
        </div>
    </div>
</div>
<div class="login-register-area bg-gray pt-155 pb-160">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-form-container">
                        <div class="login-register-form">
                            <?php  ActiveForm::begin([
                                'id' => 'pass-reset',
                                'method'=>'post',
                                'action' => Url::current(),
                                'enableClientValidation' => true,
                                'errorCssClass' => 'text-danger',
                            ]) ?>
                            <div class="form-group required">
                                <label class="control-label" for="email_login">Email/Логин</label>
                                <input type="text" id="email_login" class="mb-1" name="data" aria-required="true" placeholder="Введите почту или логин">
                            </div>
                            <div class="button-box">
                                <button type="submit">Отправить письмо с подтверждением</button>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
