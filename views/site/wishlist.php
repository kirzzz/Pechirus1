<?php
/* @var $this yii\web\View */
/* @var $products Product[] */

use app\models\Basket;
use app\models\Product;
use app\models\Wishlist;
use yii\helpers\Url;

$this->title = 'Pechirus: Понравившиеся товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumb-area breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Понравившиеся товары</h2>
            <ul>
                <li>
                    <a href="<?= Url::toRoute(['site/index'])?>">Главная</a>
                </li>
                <li><span> > </span></li>
                <li>
                    <a href="<?= Url::toRoute(['site/list'])?>">Продукты</a>
                </li>
                <li><span> > </span></li>
                <li class="active">Понравившиеся товары</li>
            </ul>
        </div>
    </div>
</div>
<div class="cart-area bg-gray pt-160 pb-160">
    <div class="container">
        <?php if(!empty($products)): ?>
            <div class="cart-table-content wishlist-wrap">
                <div class="table-content table-responsive">
                    <table style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Продукт</th>
                            <th class="th-text-center">Цена</th>
                            <th class="th-text-center">Добавить</th>
                            <th></th>
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
                                            <?= !$product->getCatalogName()?'':"Каталог: <span>".$product->getCatalogName()."</span>" ?>
                                        </div>
                                    </div>
                                </td>
                                <?php $price = $product->new_price?$product->new_price:$product->price ?>
                                <td class="product-price"><span class="amount"><?= "&#8381;".$price ?></span></td>
                                <?php
                                if(!Yii::$app->user->isGuest) {
                                    $wishlist = Basket::find()->where(['idUser' => Yii::$app->user->id])->andWhere(['status' => Basket::STATUS_ADD])->andWhere(['idProduct' => $product->id])->all();
                                }else{
                                    $wishlist = Yii::$app->session->get('basket');
                                }
                                $wishlist = (!empty($wishlist) and array_search($product->id,array_column($wishlist,'idProduct')) !== false and isset($wishlist[array_search($product->id,array_column($wishlist,'idProduct'))]['idProduct']));
                                ?>
                                <td class="product-wishlist-cart">
                                    <a title="Добавить в корзину" <?php if(!$wishlist):?>data-basket-mini-type="basket"  data-basket-mini-add="<?= $product->id ?>" <?php else:?> disabled="disabled" <?php endif; ?>><?= $wishlist?'Уже в корзине':"Добавить в корзину"?></a>
                                </td>
                                <td class="product-wishlist-cart">
                                    <a data-basket-mini-delete="<?= $product->id ?>" data-basket-mini-type="wishlist"><img class="inject-me" src="<?= Url::to(['@web/site/']) ?>/images/icon-img/close.svg" alt=""></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else:?>
            <div class="empty-cart-content text-center">
                <img src="<?= Url::to(['@web/site/']) ?>/images/cart/broken-heart.png" alt="logo">
                <h3>Вы не выбрали ни одного продукта.</h3>
                <div class="empty-cart-btn">
                    <a href="<?= Url::toRoute(['site/list']) ?>">Вернуться в магазин</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
