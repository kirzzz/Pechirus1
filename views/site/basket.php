<?php
/* @var $this yii\web\View */
/* @var $products Product[] */
/* @var $basket Basket[] */

use app\models\Basket;
use app\models\Product;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Pechirus: Корзина';
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
                <li>
                    <a href="<?= Url::toRoute(['site/list'])?>">Продукты</a>
                </li>
                <li><span> > </span></li>
                <li class="active">Корзина</li>
            </ul>
        </div>
    </div>
</div>
<div class="cart-check-order-link-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 ml-auto mr-auto">
                <div class="cart-check-order-link">
                    <a class="active"href="<?= Url::toRoute(['site/basket'])?>">Корзина</a>
                    <a href="<?= Url::toRoute(['site/order'])?>">Оформление заказа</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cart-area bg-gray pt-160 pb-160">
    <div class="container">
        <?php if(!empty($products)): ActiveForm::begin(['method' => 'post','action' => Url::toRoute(['site/basket','type'=>'update'])]) ?>
            <div class="cart-table-content">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                        <tr>
                            <th>Продукт</th>
                            <th class="th-text-center">Цена</th>
                            <th class="th-text-center">Количество</th>
                            <th class="th-text-center">Общая цена</th>
                            <th class="th-text-center">Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product):?>
                        <tr>
                            <td class="cart-product">
                                <div class="product-img-info-wrap">
                                    <div class="product-img">
                                        <a href="<?=Url::to(['site/product','id'=>$product->id])?>"><img src="/<?= $product->img !== '[]'?json_decode($product->img,true)[0]['path']:'images/default/no-image.png'?>" alt=""></a>
                                    </div>
                                    <div class="product-info" style="flex: 1">
                                        <h4><a href="<?=Url::to(['site/product','id'=>$product->id])?>"><?= $product->name ?></a></h4>
                                        <?= !$product->getBrandName()?'':"Брэнд: <span>".$product->getBrandName()."</span>" ?>
                                    </div>
                                </div>
                            </td>
                            <?php $price = $product->new_price?$product->new_price:$product->price ?>
                            <?php $trig = isset($basket[0]['idProduct'])?1:0 ?>
                            <?php $count = $basket[array_keys($basket)[array_search($product->id,array_column($basket,'idProduct'))]]['count'] ?>
                            <td class="product-price"><span class="amount"><?= "&#8381;".$price ?></span></td>
                            <td class="cart-quality">
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus" data-max-val="<?= $product->count ?>" data-price="<?= $product->price ?>">
                                        <input name="Basket[count][]" data-count-product class="cart-plus-minus-box plus-minus-width-inc" type="text" value="<?= $count ?>">
                                    </div>
                                </div>
                            </td>
                            <td class="product-total">&#8381;<span data-price-inp><?= ($price*$count) ?></span></td>
                            <td class="product-remove"><a data-remove-product data-basket-mini-delete="<?= $product->id ?>" data-basket-mini-type="basket"><img class="inject-me" src="<?= Url::to(['@web/site/']) ?>/images/icon-img/close.svg" alt=""></a></td>
                            <input type="hidden" name="Basket[product_id][]" value="<?= $product->id ?>">
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="cart-shiping-update-wrapper">
                    <a href="<?=Url::toRoute(['site/list'])?>">Продолжить покупки</a>
                    <button style="background: transparent" type="submit">Обновить корзину</button>
                    <a href="<?=Url::toRoute(['site/basket','type'=>'clear'])?>">Очисить корзину</a>
                </div>
            </div>
            <div class="proceed-btn">
                <button formaction="<?= Url::toRoute(['site/basket','type'=>'order']) ?>">Оформить заказ</button>
            </div>
        <?php ActiveForm::end(); else:?>
            <div class="empty-cart-content text-center">
                <img src="<?= Url::to(['@web/site/']) ?>/images/cart/empty-cart.png" alt="logo">
                <h3>Ваша корзина пуста.</h3>
                <div class="empty-cart-btn">
                    <a href="<?= Url::toRoute(['site/list']) ?>">Вернуться в магазин</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
