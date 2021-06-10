<?php
/* @var $this yii\web\View */
/* @var $product \app\models\Product */
/* @var $comment \app\models\Comments */

use app\models\Basket;
use app\models\Compare;
use app\models\Wishlist;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Pechirus: Продукт - '.$product->name;
$this->registerMetaTag(['name' => 'keywords', 'content' => 'ПечиРус, Pechirus, Печи, '.implode(',',explode(' ',$product->name))]);
$this->registerMetaTag(['name' => 'description', 'content' => $product->name .','.$product->description.'Печи в Москве от надежных поставщиков по низким ценам с гарантией. Телефон для консультации +7 (495) 540-47-03. Печи, Котлы, Дымоходы и аксессуары для бани и сауны. Более 3-х тысяч товаров.']);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-details-area product-details-bg pt-160 slider-mt-7 ">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="product-details-tab-wrap">
                    <div class="product-details-tab-large tab-content pt-40 text-center">
                        <?php $images = $product->img !== '[]' ? json_decode($product->img, true) : 'images/default/no-image.png' ?>
                        <?php if(is_array($images)): foreach ($images as $index=>$img): ?>
                            <div class="tab-pane <?=$index == 0?'active':''?>" id="pro-details<?=$index?>">
                                <div class="product-details-2-img ">
                                    <img style="mix-blend-mode: multiply;" src="/<?= $img['path'] ?>" alt="">
                                </div>
                            </div>
                        <?php endforeach; else:?>
                            <div class="tab-pane active" id="pro-details1">
                                <div class="product-details-2-img ">
                                    <img style="mix-blend-mode: multiply;" src="/<?= $images ?>" alt="defauls">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="product-details-shape pro-dec-shape1">
                            <img src="<?=Url::to('@web/site/')?>images/product-details/product-details-shape.png" alt="">
                        </div>
                    </div>
                    <div class="product-details-tab-small nav">
                        <?php if(is_array($images)): foreach ($images as $index=>$img): ?>
                            <a <?=$index == 0?'class="active"':''?> href="#pro-details<?=$index?>">
                                <img style="mix-blend-mode: multiply;" src="/<?= $img['path'] ?>" alt="">
                            </a>
                        <?php endforeach; else:?>
                            <a class="active" href="#pro-details1">
                                <img style="mix-blend-mode: multiply;" src="/<?= $images ?>" alt="">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="product-details-content main-product-details-content">
                    <h2><?= $product->name ?></h2>
                    <?php ActiveForm::begin(['action' => Url::toRoute(['site/order']),'method' => 'get']) ?>
                    <div class="product-ratting-review-wrap">
                        <div class="product-ratting-digit-wrap">
                            <div class="product-ratting">
                                <?php $rating = $product->getRaiting() ?>
                                <?php for($i=0;$i<5;$i++){
                                    if($rating > $i)
                                        echo '<i class="icon-rating"></i>';
                                    else
                                        echo '<i class="icon-star-empty"></i>';
                                } ?>
                            </div>
                            <div class="product-digit">
                                <span><?= round($rating) ?></span>
                            </div>
                        </div>
                        <div class="product-review-order">
                            <span>Коментариев <?= $product->getCount('comments') ?></span>
                            <span>Заказов <?= $product->getCount('orders') ?></span>
                            <span class="<?= $product->in_stock?'text-success':'' ?>"><?= $product->in_stock?'В наличии':'Под заказ' ?></span>
                        </div>
                    </div>
                    <div class="pro-details-price">
                        <?= $product->new_price?"<span>&#8381;".$product->new_price."</span><span class='old-price'>&#8381; ".$product->price."</span>":"<span>&#8381;".$product->price."</span>" ?>
                    </div>
                    <div class="pro-details-quality">
                        <span>Количество:</span>
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" type="text" name="count" value="1">
                        </div>
                    </div>
                    <?php $brand_name = $product->getBrandName()?>
                    <div class="product-details-meta">
                        <ul>
                            <li><span>Артикул:</span> <a href="#"><?= $product->article ?></a></li>
                            <?php if($brand_name): ?>
                            <li><span>Брэнд:</span> <a href="#"><?= $brand_name ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="pro-details-action-wrap mt-3">
                        <div class="pro-details-buy-now">
                            <button style="border: none" type="submit">Купить</button>
                            <input type="hidden" name="id" value="<?= $product->id ?>">
                        </div>
                        <div class="pro-details-action">
                            <?php
                            if(!Yii::$app->user->isGuest) {
                                $basket = Basket::find()->where(['idUser' => Yii::$app->user->id])->andWhere(['status' => Basket::STATUS_ADD])->andWhere(['idProduct' => $product->id])->all();
                                $compare = Compare::find()->where(['idUser' => Yii::$app->user->id])->andWhere(['status' => Basket::STATUS_ADD])->andWhere(['idProduct' => $product->id])->all();
                                $wishlist = Wishlist::find()->where(['idUser' => Yii::$app->user->id])->andWhere(['status' => Basket::STATUS_ADD])->andWhere(['idProduct' => $product->id])->all();
                            }else{
                                $basket = Yii::$app->session->get('basket');
                                $compare = Yii::$app->session->get('compare');
                                $wishlist = Yii::$app->session->get('wishlist');
                            }
                            $basket = (!empty($basket) and array_search($product->id,array_column($basket,'idProduct')) !== false and isset($basket[array_search($product->id,array_column($basket,'idProduct'))]['idProduct']));
                            $compare = (!empty($compare) and array_search($product->id,array_column($compare,'idProduct')) !== false and isset($compare[array_search($product->id,array_column($compare,'idProduct'))]['idProduct']));
                            $wishlist = (!empty($wishlist) and array_search($product->id,array_column($wishlist,'idProduct')) !== false and isset($wishlist[array_search($product->id,array_column($wishlist,'idProduct'))]['idProduct']));
                            ?>
                            <a title="Добавить в корзину" data-basket-mini-type="basket" <?= $basket?'class="active" data-basket-mini-delete="'. $product->id .'"':'data-basket-mini-add="'. $product->id .'"'?>><i class="icon-basket"></i></a>
                            <a title="Добавить в сравнение" data-basket-mini-type="compare" <?= $compare?'class="active" data-basket-mini-delete="'. $product->id .'"':'data-basket-mini-add="'. $product->id .'"'?>><i class="icon-compare"></i></a>
                            <a title="Добавить в понравившиеся" data-basket-mini-type="wishlist" <?= $wishlist?'class="active" data-basket-mini-delete="'. $product->id .'"':'data-basket-mini-add="'. $product->id .'"'?>><i class="icon-heart"></i></a>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="description-review-wrapper pt-105 pb-155">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dec-review-topbar nav mb-65">
                    <a  data-toggle="tab" href="#des-details1">Опиание</a>
                    <a data-toggle="tab" href="#des-details2">Характеристики</a>
                    <a class="active" data-toggle="tab" href="#des-details3">Отзывы и рейтинг</a>
                </div>
                <div class="tab-content dec-review-bottom">
                    <div id="des-details1" class="tab-pane">
                        <div class="description-wrap">
                            <?= $product->description?$product->description:'У данного товара отсутствует описание.'; ?>
                        </div>
                    </div>
                    <div id="des-details2" class="tab-pane">
                        <div class="specification-wrap table-responsive">
                            <?php $options = json_decode($product->property,true) ?>
                            <?php if($options):?>
                            <table>
                                <tbody>
                                <?php if(isset($options['myrows'])): foreach ($options['myrows'] as $option):?>
                                    <tr>
                                        <td class="width1"><?= $option['name'] ?></td>
                                        <td><?= $option['value'] ?></td>
                                    </tr>
                                <?php endforeach; endif;?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                У данного товара отсутствуют характеристики.
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane active">
                        <div class="review-wrapper">
                            <h2><?= $product->getCount('comments') ?> отзывов</h2>
                            <?php if(count($product['comments'])): foreach ($product['comments'] as $comment): ?>
                            <div class="single-review">
                                <div class="review-content">
                                    <div class="review-top-wrap">
                                        <div class="review-name">
                                            <h5><span><?= (new \app\models\Comments)->getName($comment['id'])?></span> - <?= date('d.m.Y H:i:s',$comment['created_at'])?></h5>
                                        </div>
                                        <div class="review-rating">
                                            <?php for($i=0;$i<5;$i++){
                                                if($comment['rating'] > $i)
                                                    echo '<i class="icon-rating" style="color: #f5b223"></i>';
                                                else
                                                    echo '<i class="icon-star-empty"></i>';
                                            } ?>
                                        </div>
                                    </div>
                                    <p><?= $comment['text'] ?></p>
                                </div>
                            </div>
                            <?endforeach; endif;?>
                        </div>
                        <div class="ratting-form-wrapper">
                            <span>Оставить отзыв</span>
                            <div class="ratting-form">
                                <?php  $form = ActiveForm::begin([
                                    'method' => 'post','action' => Url::current(),'enableClientValidation' => true,'errorCssClass' => 'text-danger'
                                ]) ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="rating-form-style mb-20">
                                                <?= $form->field($comment,'name',['inputOptions'=>['class'=>'mb-1']]) ?>
                                            </div>
                                        </div>
                                        <?php if(Yii::$app->user->isGuest):?>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="rating-form-style mb-20">
                                                <?= $form->field($comment,'email',['inputOptions'=>['class'=>'mb-1','type'=>'email']]) ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-lg-12">
                                            <div class="star-box-wrap">
                                                <div class="single-ratting-star">
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                </div>
                                                <div class="single-ratting-star">
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                </div>
                                                <div class="single-ratting-star">
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                </div>
                                                <div class="single-ratting-star">
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                </div>
                                                <div class="single-ratting-star">
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-rating"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?= $form->field($comment,'rating',['inputOptions'=>['class'=>'mb-1','type'=>'hidden']])->label(false) ?>
                                        <?= $form->field($comment,'idProduct',['inputOptions'=>['class'=>'mb-1','value'=>$product->id,'type'=>'hidden']])->label(false) ?>
                                        <div class="col-md-12">
                                            <div class="rating-form-style mb-20">
                                                <?= $form->field($comment,'text')->textarea() ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-submit">
                                                <?= \yii\helpers\Html::error($comment,'rating')?>
                                                <input type="submit" value="Добавить">
                                            </div>
                                        </div>
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
<!--<div class="product-area pb-155">
    <div class="container">
        <div class="section-title-8 mb-65">
            <h2>You May Like Also</h2>
        </div>
        <div class="product-slider-active-4">
            <div class="product-wrap-plr-1">
                <div class="product-wrap">
                    <div class="product-img product-img-zoom mb-25">
                        <a href="product-details.html">
                            <img src="<?/*=Url::to('@web/site/')*/?>images/product/product-151.jpg" alt="">
                        </a>
                    </div>
                    <div class="product-content">
                        <h4><a href="product-details.html">Product Title</a></h4>
                        <div class="product-price">
                            <span>$ 124</span>
                            <span class="old-price">$ 130</span>
                        </div>
                    </div>
                    <div class="product-action-position-1 text-center">
                        <div class="product-content">
                            <h4><a href="product-details.html">Product Title</a></h4>
                            <div class="product-price">
                                <span>$ 124</span>
                                <span class="old-price">$ 130</span>
                            </div>
                        </div>
                        <div class="product-action-wrap">
                            <div class="product-action-cart">
                                <button title="Add to Cart">Add to cart</button>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModal"><i class="icon-zoom"></i></button>
                            <button title="Add to Compare"><i class="icon-compare"></i></button>
                            <button title="Add to Wishlist"><i class="icon-heart-empty"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-wrap-plr-1">
                <div class="product-wrap">
                    <div class="product-img product-img-zoom mb-25">
                        <a href="product-details.html">
                            <img src="<?/*=Url::to('@web/site/')*/?>images/product/product-152.jpg" alt="">
                        </a>
                    </div>
                    <div class="product-content">
                        <h4><a href="product-details.html">Product Title</a></h4>
                        <div class="product-price">
                            <span>$ 124</span>
                            <span class="old-price">$ 130</span>
                        </div>
                    </div>
                    <div class="product-action-position-1 text-center">
                        <div class="product-content">
                            <h4><a href="product-details.html">Product Title</a></h4>
                            <div class="product-price">
                                <span>$ 124</span>
                                <span class="old-price">$ 130</span>
                            </div>
                        </div>
                        <div class="product-action-wrap">
                            <div class="product-action-cart">
                                <button title="Add to Cart">Add to cart</button>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModal"><i class="icon-zoom"></i></button>
                            <button title="Add to Compare"><i class="icon-compare"></i></button>
                            <button title="Add to Wishlist"><i class="icon-heart-empty"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-wrap-plr-1">
                <div class="product-wrap">
                    <div class="product-img product-img-zoom mb-25">
                        <a href="product-details.html">
                            <img src="<?/*=Url::to('@web/site/')*/?>images/product/product-153.jpg" alt="">
                        </a>
                    </div>
                    <div class="product-content">
                        <h4><a href="product-details.html">Product Title</a></h4>
                        <div class="product-price">
                            <span>$ 124</span>
                            <span class="old-price">$ 130</span>
                        </div>
                    </div>
                    <div class="product-action-position-1 text-center">
                        <div class="product-content">
                            <h4><a href="product-details.html">Product Title</a></h4>
                            <div class="product-price">
                                <span>$ 124</span>
                                <span class="old-price">$ 130</span>
                            </div>
                        </div>
                        <div class="product-action-wrap">
                            <div class="product-action-cart">
                                <button title="Add to Cart">Add to cart</button>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModal"><i class="icon-zoom"></i></button>
                            <button title="Add to Compare"><i class="icon-compare"></i></button>
                            <button title="Add to Wishlist"><i class="icon-heart-empty"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-wrap-plr-1">
                <div class="product-wrap">
                    <div class="product-img product-img-zoom mb-25">
                        <a href="product-details.html">
                            <img src="<?/*=Url::to('@web/site/')*/?>images/product/product-154.jpg" alt="">
                        </a>
                    </div>
                    <div class="product-content">
                        <h4><a href="product-details.html">Product Title</a></h4>
                        <div class="product-price">
                            <span>$ 124</span>
                            <span class="old-price">$ 130</span>
                        </div>
                    </div>
                    <div class="product-action-position-1 text-center">
                        <div class="product-content">
                            <h4><a href="product-details.html">Product Title</a></h4>
                            <div class="product-price">
                                <span>$ 124</span>
                                <span class="old-price">$ 130</span>
                            </div>
                        </div>
                        <div class="product-action-wrap">
                            <div class="product-action-cart">
                                <button title="Add to Cart">Add to cart</button>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModal"><i class="icon-zoom"></i></button>
                            <button title="Add to Compare"><i class="icon-compare"></i></button>
                            <button title="Add to Wishlist"><i class="icon-heart-empty"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-wrap-plr-1">
                <div class="product-wrap">
                    <div class="product-img product-img-zoom mb-25">
                        <a href="product-details.html">
                            <img src="<?/*=Url::to('@web/site/')*/?>images/product/product-152.jpg" alt="">
                        </a>
                    </div>
                    <div class="product-content">
                        <h4><a href="product-details.html">Product Title</a></h4>
                        <div class="product-price">
                            <span>$ 124</span>
                            <span class="old-price">$ 130</span>
                        </div>
                    </div>
                    <div class="product-action-position-1 text-center">
                        <div class="product-content">
                            <h4><a href="product-details.html">Product Title</a></h4>
                            <div class="product-price">
                                <span>$ 124</span>
                                <span class="old-price">$ 130</span>
                            </div>
                        </div>
                        <div class="product-action-wrap">
                            <div class="product-action-cart">
                                <button title="Add to Cart">Add to cart</button>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModal"><i class="icon-zoom"></i></button>
                            <button title="Add to Compare"><i class="icon-compare"></i></button>
                            <button title="Add to Wishlist"><i class="icon-heart-empty"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<script type="text/javascript">
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        "ecommerce": {
            "detail": {
                "products": [
                    {
                        "id": "<?= $product->article ?>",
                        "name" : "<?= htmlspecialchars($product->name,ENT_COMPAT) ?>",
                        "price": "<?= $product->price ?>",
                        "brand": "<?= $product->getBrandName() ?>",
                        "category": "<?= $product->getCatalogName() ?>",
                    }
                ]
            }
        }
    });
</script>
