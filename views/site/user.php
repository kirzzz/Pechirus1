<?php
/* @var $this yii\web\View */
/* @var $orders Orders[] */
/* @var $user User */
/* @var $pass ChangePassword */

use app\models\ChangePassword;
use app\models\Orders;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$this->title = 'Pechirus: Аккаунт - '.$user->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumb-area breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2><?= (isset($user->name) or isset($user->surname))?((isset($user->name)?$user->name:'') . ' ' . (isset($user->surname)?$user->surname:'')):$user->username ?></h2>
            <ul>
                <li>
                    <a href="<?= Url::toRoute(['site/index'])?>">Главная</a>
                </li>
                <li><span> > </span></li>
                <li class="active">Аккаунт</li>
            </ul>
        </div>
    </div>
</div>
<div class="my-account-wrapper bg-gray pt-160 pb-160">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active" data-toggle="tab">Главная</a>
                                <a href="#orders" data-toggle="tab">Заказы</a>
                                <a href="#address-edit" data-toggle="tab">Адресс</a>
                                <a href="#account-info" data-toggle="tab">Настройки Аккаунта</a>
                                <a href="<?= Url::toRoute(['site/logout']) ?>">Выйти</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Мой аккаунт</h3>
                                        <div class="welcome">
                                            <p>Зравствуйте, <strong><?= (isset($user->name) or isset($user->surname))?((isset($user->name)?$user->name:'') . ' ' . (isset($user->surname)?$user->surname:'')):$user->username ?></strong></p>
                                        </div>
                                        <p class="mb-0">С помощью панели управления аккаунтом Вы можете просматривать свои заказы, а также изменять основные данные Вашего аккаунта.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Заказы</h3>
                                        <?php if(!empty($orders)):?>
                                        <div class="myaccount-table table-responsive text-center cart-table-content">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>№ Заказа</th>
                                                    <th>Дата</th>
                                                    <th>Сумма</th>
                                                    <th>Статус</th>
                                                    <th>Действие</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($orders as $order):?>
                                                    <tr>
                                                        <td><?= $order->article ?></td>
                                                        <td><?= date('d.m.y H:i:s',$order->created_at) ?></td>
                                                        <td>&#8381;<?= $order->price ?></td>
                                                        <td><?= Orders::STATUS_DESCRIPTION[$order->status] ?></td>
                                                        <td>
                                                            <?php if($order->status > Orders::STATUS_CANCELED and $order->status < Orders::STATUS_ACTIVE):?>
                                                            <button data-order-trash="<?= $order->id ?>" class="btn btn-outline-danger btn-group-lg"><i class="icofont-trash"></i></button>
                                                            <?php endif; ?>
                                                            <button data-order-show-product="<?= $order->id ?>" class="btn btn-outline-info btn-group-lg"><i class="icofont-eye"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php $products = json_decode($order->productInfo,true); ?>
                                                    <?php foreach ($products as $product):?>
                                                    <?php $product_m = \app\models\Product::find()->andWhere(['id'=>$product['idProduct']])->one() ?>
                                                    <?php $image = $product_m->img !== '[]'?json_decode($product_m->img,true)[0]['path']:'images/default/no-image.png'?>
                                                    <tr style="display: none" data-order-show-product="<?= $order->id ?>">
                                                        <td class="cart-product" colspan="5">
                                                            <div class="product-img-info-wrap">
                                                                <div class="product-img">
                                                                    <a href="<?= Url::toRoute(['site/product','id'=>$product['idProduct']])?>"><img src="/<?= $image ?>" alt=""></a>
                                                                </div>
                                                                <div class="product-info">
                                                                    <h4><a href="#"><?= $product_m->name ?></a></h4>
                                                                    <span>Количество:  <?= $product['count'] ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php else:?>
                                        <p class="mb-0">Вы еще не совершили ни одного заказа</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Ваши контакты:</h3>
                                        <address>
                                            <p><strong><?= (isset($user->name) or isset($user->surname))?((isset($user->name)?$user->name:'') . ' ' . (isset($user->surname)?$user->surname:'')):$user->username ?></strong></p>
                                            <p>Адресс: <?= isset($user->address)?$user->address:"Не указан"?></p>
                                            <p>Телефон: <?= isset($user->tel)?$user->tel:"Не указан"?></p>
                                        </address>
                                        <a href="#account-info" class="check-btn sqr-btn "><i class="fa fa-edit"></i> Изменить</a>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Настройки Аккаунта</h3>
                                        <div class="account-details-form">
                                            <?php $form = ActiveForm::begin(['method' => 'post','action' => Url::toRoute(['site/user']),'enableClientValidation' => true,'errorCssClass' => 'text-danger','options' => ['class'=>'mb-40']]) ?>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <?= $form->field($user,'name',['inputOptions'=>['class'=>'mb-1']]) ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <?= $form->field($user,'surname',['inputOptions'=>['class'=>'mb-1']]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <?= $form->field($user,'username',['inputOptions'=>['class'=>'mb-1']]) ?>
                                                </div>
                                                <div class="single-input-item">
                                                    <?= $form->field($user,'email',['inputOptions'=>['class'=>'mb-1','type'=>'email']]) ?>
                                                </div>
                                                <div class="single-input-item">
                                                    <?= $form->field($user,'tel',['inputOptions'=>['class'=>'mb-1']])->widget(MaskedInput::className(), ['mask' => '+7 (999) 999-99-99']) ?>
                                                </div>
                                                <div class="single-input-item">
                                                    <?= $form->field($user,'address',['inputOptions'=>['class'=>'mb-1']]) ?>
                                                </div>
                                                <div class="single-input-item mb-4">
                                                    <button class="check-btn sqr-btn" type="submit">Сохранить изменения</button>
                                                </div>
                                            <?php ActiveForm::end() ?>
                                            <?php $form_pass = ActiveForm::begin(['method' => 'post','action' => Url::toRoute(['site/user']),'enableClientValidation' => true,'errorCssClass' => 'text-danger']) ?>
                                                <fieldset>
                                                    <legend>Изменить пароль</legend>
                                                    <div class="single-input-item">
                                                        <div class="single-input-item">
                                                            <?= $form_pass->field($pass,'old_password',['inputOptions'=>['class'=>'mb-1','type'=>'password']]) ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <?= $form_pass->field($pass,'new_password',['inputOptions'=>['class'=>'mb-1','type'=>'password']]) ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <?= $form_pass->field($pass,'repeat_password',['inputOptions'=>['class'=>'mb-1','type'=>'password']]) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="single-input-item text-right">
                                                                <a href="<?= Url::toRoute(['site/password-reset'])?>">Забыли пароль?</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn" type="submit">Сохранить изменения</button>
                                                </div>
                                            <?php ActiveForm::end() ?>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<div style="display:none;" id="modal-order" class="h-auto">
    <div class="row">
        <div class="col-2 align-self-center"><h1 class="text-info"><i class="icofont-question h-100"></i></h1></div>
        <div class="col-10 d-flex flex-column">
            <p>Вы уверены что хотите отменить заказ?</p>
            <div class="btn-group">
                <a class="btn btn-outline-success" rel="modal:close"><i class="icofont-close mr-2"></i>Нет</a>
                <a class="btn btn-outline-danger" rel="modal:close" data-remove-order-complete=""><i class="icofont-check mr-2"></i>Да</a>
            </div>
        </div>
    </div>
</div>
