<?php
/* @var $this yii\web\View */
/* @var $products Product[] */

use app\models\Product;
use yii\helpers\Url;

$this->title = 'Pechirus: Сравнение продуктов';
?>
<div class="breadcrumb-area breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Сравнение</h2>
            <ul>
                <li>
                    <a href="<?= Url::toRoute(['site/index'])?>">Главная</a>
                </li>
                <li><span> > </span></li>
                <li>
                    <a href="<?= Url::toRoute(['site/list'])?>">Продукты</a>
                </li>
                <li><span> > </span></li>
                <li class="active">Сравнение</li>
            </ul>
        </div>
    </div>
</div>
<div class="compare-page-wrapper bg-gray pt-160 pb-160">
    <div class="container">
        <?php if(!empty($products)):?>
        <div class="row">
            <div class="col-lg-12">
                <!-- Compare Page Content Start -->
                <div class="compare-page-content-wrap">
                    <div class="compare-table table-responsive">
                        <table class="table table-bordered mb-0">
                            <tr>
                                <td class="first-column">Продукт</td>
                                <?php foreach ($products as $product):?>
                                    <td class="product-image-title" data-compare-id="<?= $product->id ?>">
                                        <a href="<?=Url::toRoute(['site/product','id'=>$product->id])?>" class="image">
                                            <img class="img-fluid" src="/<?= $product->img !== '[]'?json_decode($product->img,true)[0]['path']:'images/default/no-image.png'?>" alt="Сравнение продуктов">
                                        </a>
                                        <a href="<?=Url::toRoute(['site/list','catalog'=>$product->idCatalog])?>" class="category"><?= $product->getCatalogName() ?></a>
                                        <a href="<?=Url::toRoute(['site/product','id'=>$product->id])?>" class="title"><?= $product->name ?></a>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="first-column">Описание</td>
                                <?php foreach ($products as $product):?>
                                    <td class="pro-desc" data-compare-id="<?= $product->id ?>">
                                        <p><?= $product->description?$product->description:'У данного товара отсутствует описание.'; ?></p>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="first-column">Характеристики</td>
                                <?php foreach ($products as $product):?>
                                    <?php $options = json_decode($product->property,true) ?>
                                <td class="pro-color" data-compare-id="<?= $product->id ?>">
                                    <?php if($options):?>
                                        <ul>
                                        <?php if(isset($options['myrows'])): foreach ($options['myrows'] as $option):?>
                                            <li>
                                                <span><?= $option['name'] ?></span>:
                                                <span><?= $option['value'] ?></span>
                                            </li>
                                        <?php endforeach; endif;?>
                                        </ul>
                                    <?php else: ?>
                                        У данного товара отсутствуют характеристики.
                                    <?php endif; ?>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="first-column">Цена</td>
                                <?php foreach ($products as $product):?>
                                    <td class="pro-price" data-compare-id="<?= $product->id ?>"><?= $product->new_price?"<span>&#8381;".$product->new_price."</span>":"<span>&#8381;".$product->price."</span>" ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="first-column">Наличие</td>
                                <?php foreach ($products as $product):?>
                                    <td class="pro-stock" data-compare-id="<?= $product->id ?>"><?= $product->in_stock?'В наличии':'Нет в наличии' ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="first-column">Добавить в корзину</td>
                                <?php foreach ($products as $product):?>
                                    <td data-compare-id="<?= $product->id ?>"><a title="Добавить в корзину" data-basket-mini-type="basket" data-basket-mini-add="<?= $product->id ?>" class="check-btn">Добавить</a></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="first-column">Рейтинг</td>
                                <?php foreach ($products as $product):?>
                                    <td class="pro-ratting" data-compare-id="<?= $product->id ?>">
                                        <?php $rating = $product->getRaiting() ?>
                                        <?php for($i=0;$i<5;$i++){
                                            if($rating > $i)
                                                echo '<i class="icon-rating"></i>';
                                            else
                                                echo '<i class="icon-star-empty"></i>';
                                        } ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="first-column">Удалить</td>
                                <?php foreach ($products as $product):?>
                                    <td class="pro-remove" data-compare-id="<?= $product->id ?>">
                                        <a data-basket-mini-delete="<?= $product->id ?>" data-basket-mini-type="compare"><img class="inject-me" src="<?= Url::to(['@web/site/']) ?>/images/icon-img/close.svg" alt=""></a>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Compare Page Content End -->
            </div>
        </div>
        <?php else: ?>
            <div class="empty-cart-content text-center">
                <img src="<?= Url::to(['@web/site/']) ?>/images/cart/decision.png" alt="logo">
                <h3>Вы не добавили ни одного продукта для сравнения.</h3>
                <div class="empty-cart-btn">
                    <a href="<?= Url::toRoute(['site/list']) ?>">Вернуться в магазин</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>