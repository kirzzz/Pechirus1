<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="breadcrumb-area bg-theme-color-main breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Ошибка</h2>
            <ul>
                <li>
                    <a href="<?= Url::toRoute(['site/index'])?>">Главная</a>
                </li>
                <li><span> > </span></li>
                <li class="active">Ошибка!</li>
            </ul>
        </div>
    </div>
</div>
<div class="main-wrapper">
    <div class="error-area height-100vh">
        <div class="container-fluid p-0 height-100vh">
            <div class="row no-gutters align-items-center">
                <div class="col-lg-12">
                    <div class="error-content text-center">
                        <h1 class="text-dark" style="line-height: 125%"><?= Html::encode($this->title) ?></h1>
                        <h3 class="text-dark"><?= nl2br(Html::encode($message)) ?></h3>
                        <div class="error-btn btn-hover">
                            <a class="bg-black-hover" href="<?=Url::toRoute('site/index')?>">Вернуться на Главную</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>