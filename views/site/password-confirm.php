<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = 'Pechirus: Изменение пароль';
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
                <li><a href="<?= Url::toRoute(['site/password-reset'])?>"> Восстановление аккаунта</a> </li>
                <li><span> > </span></li>
                <li class="active"> Изменить пароль </li>
            </ul>
        </div>
    </div>
</div>
<div class="login-register-area bg-gray pt-155 pb-160">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="tab-content">
                        <div class="login-form-container">
                            <div class="login-register-form">
                            <?php if(isset($reset) and $reset !== false): ?>
                            <?php  $login = ActiveForm::begin([
                                'id' => 'pass_reset',
                                'method'=>'post',
                                'action' => Url::current(),
                                'enableClientValidation' => true,
                                'errorCssClass' => 'text-danger',
                            ]) ?>
                            <?= $login->field($reset,'new_password',['inputOptions'=>['class'=>'mb-1','type'=>'password']]) ?>
                            <?= $login->field($reset,'repeat_password',['inputOptions'=>['class'=>'mb-1','type'=>'password']]) ?>
                            <div class="button-box">
                                <button type="submit">Изменить</button>
                            </div>
                            <?php ActiveForm::end() ?>
                            <?php else: ?>
                                <h2 class="text-center">Данная ссылка некорректна или ее срок действия истек.</h2>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>