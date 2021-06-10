<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Отслеживание заказа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumb-area breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Отслеживание заказа</h2>
            <ul>
                <li>
                    <a href="<?= Url::toRoute(['site/index'])?>">Главная</a>
                </li>
                <li><span> > </span></li>
                <li class="active">Отслеживание заказа</li>
            </ul>
        </div>
    </div>
</div>
<!-- order tracking start -->
<div class="order-tracking-area pt-155 pb-160">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-10 ml-auto mr-auto">
                <div class="order-tracking-content">
                    <p>Для отслеживания заказа, пожалуйста, введите № Заказа который вам выдали после его оформления и Ваш Email по которому вы произвели заказ.</p>
                    <div class="order-tracking-form">
                        <?php \yii\widgets\ActiveForm::begin(['action' => Url::toRoute(['site/order-complete']),'method' => 'post'])?>
                            <div class="sin-order-tracking">
                                <label>№ Заказа</label>
                                <input type="text" name="id" placeholder="№ Заказа который вам выдали после его оформления">
                            </div>
                            <div class="sin-order-tracking">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Введите Email по которому вы произвели заказ">
                            </div>
                            <div class="order-track-btn">
                                <button type="submit">Отследить</button>
                            </div>
                        <?php \yii\widgets\ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- order tracking end -->