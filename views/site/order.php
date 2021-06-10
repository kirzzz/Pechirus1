<?php
/* @var $this yii\web\View */
/* @var $order Orders */
/* @var $login LoginForm */
/* @var $sign_up SignUpForm */
/* @var $total_price integer */

use app\models\Basket;
use app\models\LoginForm;
use app\models\Orders;
use app\models\Product;
use app\models\SignUpForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Pechirus: Оформление заказа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumb-area breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Корзина</h2>
            <ul>
                <li>
                    <a href="<?= Url::toRoute(['site/index'])?>">Главная</a>
                </li>
                <li><span> > </span></li>
                <li class="active">Оформление заказа</li>
            </ul>
        </div>
    </div>
</div>
<div class="cart-check-order-link-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 ml-auto mr-auto">
                <div class="cart-check-order-link">
                    <a href="<?= Url::toRoute(['site/basket'])?>">Корзина</a>
                    <a class="active" href="<?= Url::toRoute(['site/order'])?>">Оформление заказа</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="checkout-area bg-gray pt-160 pb-160">
    <div class="container">
        <?php $form = ActiveForm::begin(['method' => 'post','action' => Url::toRoute(['site/order']),'enableClientValidation' => true,'errorCssClass' => 'text-danger']) ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout-left-wrap">
                    <?php if(Yii::$app->user->isGuest):?>
                    <div class="login-guest-top">
                        <div class="checkout-tab nav">
                            <a href="#checkout-login" data-toggle="tab" data-order-sign-hide="#checkout-guest">
                                Войти
                            </a>
                            <a class="active" href="#checkout-guest" data-toggle="tab" data-order-sign-hide="#checkout-login">
                                Купить как гость
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="checkout-login" class="tab-pane">
                                <div class="checkout-login-wrap">
                                    <h4>Войти</h4>
                                    <div class="checkout-login-style">
                                        <?= $form->field($login,'username',['inputOptions'=>['class'=>'mb-1','disabled'=>true]]) ?>
                                        <?= $form->field($login,'password',['inputOptions'=>['class'=>'mb-1','type'=>'password','disabled'=>true]]) ?>
                                        <div class="checkout-button-box">
                                            <div class="checkout-login-toggle-btn">
                                                <?= Html::activeCheckbox($login,'rememberMe',['label' => null,'disabled'=>true]) ?>
                                                <label>Запомнить меня</label>
                                                <a href="<?= Url::toRoute(['site/password-reset'])?>">Забыли пароль?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="checkout-guest" class="tab-pane active">
                                <div class="checkout-guest-wrap">
                                    <h4>Контактная информация</h4>
                                    <div class="checkout-guest-style">
                                        <?= $form->field($sign_up,'email',['inputOptions'=>['class'=>'mb-1','type'=>'email']]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: $user = \app\models\User::findIdentity(Yii::$app->user->id); endif;?>
                    <div class="shipping-address-wrap">
                        <h4 class="checkout-title">Личные данные</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="billing-info">
                                    <?= $form->field($order,'name')->input('text',['value'=>(isset($user) and isset($user->name))?$user->name:""]) ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info">
                                    <?= $form->field($order,'surname')->input('text',['value'=>((isset($user) and isset($user->surname))?$user->surname:"")]) ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info">
                                    <?= $form->field($order,'tel')->input('text',['value'=>(isset($user) and isset($user->tel))?$user->tel:""])->widget(MaskedInput::className(), ['mask' => '+7 (999) 999-99-99'])?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout-save-info">
                                    <input class="checkout-checkbox2" type="checkbox" name="save">
                                    <span>Запомнить данные для дальнейших заказов</span>
                                </div>
                            </div>
                            <!--<div class="col-lg-6">
                                <select class="nice-select nice-select-style-3 cart-tax-select">
                                    <option>Select Country </option>
                                    <option>Bangladesh</option>
                                    <option>Bahamas</option>
                                    <option>Bahrain</option>
                                    <option>India</option>
                                    <option>Barbados</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <div class="billing-info">
                                    <input type="text" required="" placeholder="Postal Code" name="name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout-save-info">
                                    <input class="checkout-checkbox2" type="checkbox">
                                    <span>Save this information for next time</span>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="payment-details mt-40">
                    <h4 class="checkout-title">Оплата</h4>
                    <div class="payment-method">
                        <div class="pay-top sin-payment">
                            <label class="ml-0">Наличными:<span class="ml-auto">Курьеру или Самовывоз</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="payment-details mb-40">
                    <h4 class="checkout-title">Сумма заказа</h4>
                    <ul>
                        <li>В корзине: <span data-order-basket-price>&#8381; <span><?= $total_price ?></span></span></li>
                        <li>Доставка: <span>&#8381;<span data-order-delivery-price>0</span></span></li>
                    </ul>
                    <div class="total-order">
                        <ul>
                            <li>Итого: <span>&#8381;<span data-order-total-price="<?= $total_price ?>"><?= $total_price ?></span></span></li>
                        </ul>
                    </div>
                </div>
                <div class="checkout-left-wrap">
                    <div class="shipping-address-wrap mt-0">
                        <h4 class="checkout-title">Параметры доставки</h4>
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <div class="billing-info">
                                    <?= $form->field($order,'typeOfDelivery')->dropDownList(ArrayHelper::map(Orders::TYPE_OF_DELIVERY, 'id', 'name'),
                                        ['data-order-delivery-select'=>'','class' => 'nice-select nice-select-style-3 cart-tax-select','prompt' => 'Выберите тип...','options' => array_reduce(Orders::TYPE_OF_DELIVERY, function ($result, $item) {
                                            $result[$item['id']] = ['data-order-region-show' => htmlentities(json_encode($item['data-order-region-show']))];
                                            return $result;
                                        })]) ?>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4" data-order-delivery>
                                <div class="billing-info">
                                    <?= $form->field($order,'regionOfDelivery')->dropDownList(ArrayHelper::map(Orders::REGION_OF_DELIVERY, 'id', 'name'),
                                        ['options' => array_reduce(Orders::REGION_OF_DELIVERY, function ($result, $item) {
                                            $result[$item['id']] = ['data-order-region-price' => $item['data-order-region-price'], 'data-order-region-date' => $item['data-order-region-date']];
                                            return $result;
                                        }), 'class' => 'nice-select nice-select-style-3 cart-tax-select','prompt' => 'Выберите регион...','data-order-delivery-region-select'=>'' ]) ?>
                                </div>
                            </div>
                            <div class="col-lg-12" data-order-delivery>
                                <div class="billing-info">
                                    <?= $form->field($order,'address')->input('text',['value'=>(isset($user) and isset($user->address))?$user->address:""]) ?>
                                </div>
                            </div>
                            <div class="col-lg-12" data-order-delivery>
                                <div class="billing-info">
                                    <?= $form->field($order,'comment')->textarea() ?>
                                </div>
                            </div>
                            <div class="col-lg-12" data-order-delivery>
                                <div class="billing-info">
                                    <?= $form->field($order,'postalCode',['options'=>['class'=>'mb-0']]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="back-continue-wrap">
            <a href="<?= Url::toRoute(['site/basket']) ?>">Вернуться в Корзину</a>
            <button type="submit" href="<?= Url::toRoute(['site/basket']) ?>">Заказать</button>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
