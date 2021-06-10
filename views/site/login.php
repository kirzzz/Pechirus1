<?php
/* @var $this yii\web\View */
/* @var $model LoginForm */
/* @var $sign_up SignUpForm */
/* @var $type string */

use app\models\LoginForm;
use app\models\SignUpForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Pechirus: Войти / Создать аккаунт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumb-area breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Войти / Зарегестрироваться</h2>
            <ul>
                <li>
                    <a href="<?= Url::toRoute(['site/index'])?>">Главная</a>
                </li>
                <li><span> > </span></li>
                <li class="active"> Войти / Создать аккаунт </li>
            </ul>
        </div>
    </div>
</div>
<div class="login-register-area bg-gray pt-155 pb-160">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="<?= $type == 'log'?'active':''?>"  data-toggle="tab" href="#lg1">
                            <h4>Войти</h4>
                        </a>
                        <a class="<?= $type == 'sign'?'active':''?>" data-toggle="tab" href="#lg2">
                            <h4>Регистрация</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane <?= $type == 'log'?'active':''?>">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?php  $login = ActiveForm::begin([
                                        'id' => 'login',
                                        'method'=>'post',
                                        'action' => Url::current(),
                                        'enableClientValidation' => true,
                                        'errorCssClass' => 'text-danger',
                                    ]) ?>
                                        <?= $login->field($model,'username',['inputOptions'=>['class'=>'mb-1']]) ?>
                                        <?= $login->field($model,'password',['inputOptions'=>['class'=>'mb-1','type'=>'password']]) ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <?= Html::activeCheckbox($model,'rememberMe',['label' => null]) ?>
                                                <label>Запомнить меня</label>
                                                <a href="<?= Url::toRoute(['site/password-reset'])?>">Забыли пароль?</a>
                                            </div>
                                            <button type="submit">Войти</button>
                                        </div>
                                    <?php ActiveForm::end() ?>
                                </div>
                            </div>
                        </div>
                        <div id="lg2" class="tab-pane <?= $type == 'sign'?'active':''?>">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?php  $sign = ActiveForm::begin([
                                        'id' => 'sign_up',
                                        'method'=>'post',
                                        'action' => Url::current(),
                                        'enableClientValidation' => true,
                                        'errorCssClass' => 'text-danger',
                                    ]) ?>
                                        <?= $sign->field($sign_up,'username',['inputOptions'=>['class'=>'mb-1']]) ?>
                                        <?= $sign->field($sign_up,'email',['inputOptions'=>['class'=>'mb-1','type'=>'email']]) ?>
                                        <?= $sign->field($sign_up,'password',['inputOptions'=>['class'=>'mb-1','type'=>'password']]) ?>
                                        <div class="button-box">
                                            <button type="submit">Зарегестрироваться</button>
                                        </div>
                                    <?php ActiveForm::end() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
