<?php

/* @var $this yii\web\View */

use app\models\Basket;
use app\models\Compare;
use app\models\Wishlist;
use yii\helpers\Url;

$this->title = 'Главная';
$this->registerMetaTag(['name' => 'keywords', 'content' => 'Печи, Москва, Купить, Лучшие цены']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Печи в Москве от надежных поставщиков по низким ценам с гарантией. Телефон для консультации +7 (495) 540-47-03. Печи, Котлы, Дымоходы и аксессуары для бани и сауны. Более 3-х тысяч товаров.']);
?>
<div class="slider-area bg-theme-color-main slider-mt-1">
    <div class="slider-active-1 nav-style-1 dot-style-1">
        <div class="single-slider slider-height-2 custom-d-flex custom-align-item-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12 col-sm-5">
                        <div class="slider-content-1 slider-animated-1">
                            <h1 class="animated">Доставьте себе тепло и уют<br> с нашей продукцией</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 col-sm-7">
                        <div class="slider-single-img-2 slider-animated-1">
                            <a href="<?= Url::toRoute(['site/list']) ?>"><img class="animated" src="<?=Url::to('@web/site/')?>images/main/layer_2.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="single-slider slider-height-2 custom-d-flex custom-align-item-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                        <div class="slider-content-1 slider-animated-1">
                            <h1 class="animated">Be Smart With <br>Gadget</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                        <div class="slider-single-img-2 slider-animated-1">
                            <a href="#"><img class="animated" src="<?/*=Url::to('@web/site/')*/?>images/slider/electric-2-slider-1.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
    <div class="slider-shape-electric2">
        <img src="<?=Url::to('@web/site/')?>images/slider/shape-electric2.png" alt="shape">
    </div>
</div>
<div class="service-area pt-160 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="service-wrap text-center mb-30">
                    <img class="inject-me" src="<?=Url::to('@web/site/')?>images/icon-img-main/choices.svg" alt="">
                    <h3>Огромный выбор</h3>
                    <p class="service-peragraph-2">В нашем ассортименте более <?= \app\models\Product::find()->count()?> товаров</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="service-wrap text-center mb-30">
                    <img class="inject-me" src="<?=Url::to('@web/site/')?>images/icon-img-main/review.svg" alt="">
                    <h3>Нам доверяют</h3>
                    <p class="service-peragraph-2">Более 250 положительных отзывов на Яндекс.Маркете</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="service-wrap text-center mb-30">
                    <img class="inject-me" src="<?=Url::to('@web/site/')?>images/icon-img-main/best-price.svg" alt="">
                    <h3>Лучшие цены</h3>
                    <p class="service-peragraph-2">У нас лучшие цены среди конкурентов</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="service-wrap text-center mb-30">
                    <img class="inject-me" src="<?=Url::to('@web/site/')?>images/icon-img-main/support-expart.svg" alt="">
                    <h3>Поддержка</h3>
                    <p class="service-peragraph-2">Мы оказываем консультацию и дальнейшую поддержку нашим клиентам</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pt-160 pb-115">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-8">
                <div class="section-title-8">
                    <h2 class="bold">Популярные предложения</h2>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="banner-btn-4 black-2 banner-btn-4-right banner-btn-4-mrg-none">
                    <a href="<?= Url::toRoute(['site/list'])?>">Просмотреть все продукты <img class="inject-me arrow-mrg-dec" src="<?=Url::to('@web/site/')?>images/icon-img/right-arrow-banner-2.svg" alt=""></a>
                </div>
            </div>
        </div>
        <div class="product-tab-list-1 tab-list-1-left nav mt-100 mb-65">
            <a class="active" href="#product-0" data-toggle="tab">
                Все
            </a>
            <a href="#product-1" data-toggle="tab">
                Камины
            </a>
            <a href="#product-2" data-toggle="tab">
                Тандыры
            </a>
            <a href="#product-3" data-toggle="tab">
                Котлы
            </a>
            <a href="#product-4" data-toggle="tab">
                Печи для бани и сауны
            </a>
        </div>
        <div class="tab-content jump">
            <?php if(isset($products)):foreach($products as $index=>$product_list):?>
            <div id="product-<?= $index ?>" class="tab-pane <?= $index?:'active' ?>">
                <div class="row">
                <?php foreach ($product_list as $index_p=>$product): ?>
                    <div class="<?= $index_p == 0?"col-xl-4 col-lg-6 col-md-12 col-sm-12":"col-xl-2 col-lg-3 col-md-6 col-sm-6"?>">
                        <div class="product-wrap mb-40">
                            <div class="product-img product-img-zoom mb-25">
                                <a href="<?=Url::to(['site/product','id'=>$product->id])?>">
                                    <img style="max-height: 200px;object-fit: contain;" src="/<?= $product->img !== '[]'?json_decode($product->img,true)[0]['path']:'images/default/no-image.png'?>" alt="">
                                </a>
                            </div>
                            <div class="product-content">
                                <h4><a href="<?=Url::to(['site/product','id'=>$product->id])?>"><?= $product->name ?></a></h4>
                                <div class="product-price">
                                    <?= $product->new_price?"<span>&#8381;".$product->new_price."</span><span class='old-price'>&#8381; ".$product->price."</span>":"<span>&#8381;".$product->price."</span>" ?>
                                </div>
                            </div>
                            <div class="product-action-position-1 text-center">
                                <div class="product-content">
                                    <h4><a href="<?=Url::to(['site/product','id'=>$product->id])?>"><?= $product->name ?></a></h4>
                                    <div class="product-price">
                                        <?= $product->new_price?"<span>&#8381;".$product->new_price."</span><span class='old-price'>&#8381; ".$product->price."</span>":"<span>&#8381;".$product->price."</span>" ?>
                                    </div>
                                </div>
                                <div class="product-action-wrap">
                                    <div class="product-action-cart">
                                        <a title="Купить" href="<?= Url::toRoute(['site/order','id'=>$product->id])?>">Купить</a>
                                    </div>
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
                                    <button title="Добавить в корзину" data-basket-mini-type="basket" <?= $basket?'class="active" data-basket-mini-delete="'. $product->id .'"':'data-basket-mini-add="'. $product->id .'"'?>><i class="icon-basket"></i></button>
                                    <button title="Добавить в сравнение" data-basket-mini-type="compare" <?= $compare?'class="active" data-basket-mini-delete="'. $product->id .'"':'data-basket-mini-add="'. $product->id .'"'?>><i class="icon-compare"></i></button>
                                    <button title="Добавить в понравившиеся" data-basket-mini-type="wishlist" <?= $wishlist?'class="active" data-basket-mini-delete="'. $product->id .'"':'data-basket-mini-add="'. $product->id .'"'?>><i class="icon-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>

<!--<div class="banner-area section-padding-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-wrap mb-30">
                    <div class="banner-img banner-img-overflow">
                        <a href="product-details.html"><img src="<?/*=Url::to('@web/site/')*/?>images/banner/banner-5.jpg" alt=""></a>
                    </div>
                    <div class="banner-content-3-wrap">
                        <div class="banner-content-3">
                            <h3><a href="shop-fullwide.html">Super Saving </a></h3>
                            <p>MacBook Pro Offer</p>
                        </div>
                        <div class="banner-btn">
                            <a href="shop.html">Browse Collections <i class=" icon-arrow-right-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-wrap mb-30">
                            <div class="banner-img banner-img-overflow">
                                <a href="product-details.html"><img src="<?/*=Url::to('@web/site/')*/?>images/banner/banner-6.jpg" alt=""></a>
                            </div>
                            <div class="banner-content-4 banner-position-5">
                                <h3><a href="product-details.html">Up to $150 off</a></h3>
                                <p>Competently innovate end-to-end <br>relationships through timely <br> customer service. </p>
                                <div class="banner-btn-2">
                                    <a href="shop.html">Browse Collections <i class=" icon-arrow-right-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="banner-wrap mb-30">
                            <div class="banner-img banner-img-overflow">
                                <a href="product-details.html"><img src="<?/*=Url::to('@web/site/')*/?>images/banner/banner-7.jpg" alt=""></a>
                            </div>
                            <div class="banner-content-4 banner-position-6">
                                <h3><a href="product-details.html">Up to $150 off</a></h3>
                                <p>Competently innovate end-to-end <br>relationships through timely <br> customer service. </p>
                                <div class="banner-btn-2">
                                    <a href="shop.html">Browse Collections <i class=" icon-arrow-right-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<div class="categories-brand-area bg-gray-2 pt-155 pb-130">
    <div class="container">
        <div class="section-title-2 text-center mb-85">
            <h2>Популярные</h2>
        </div>
        <div class="categories-brand-tab-list nav mb-90">
            <a class="active" href="#categories-brand-1" data-toggle="tab">
                Категории
            </a>
            <a href="#categories-brand-2" data-toggle="tab">
                Брэнды
            </a>
        </div>
        <div class="tab-content jump">
            <div id="categories-brand-1" class="tab-pane active">
                <div class="row">
                    <?php foreach ($category as $cat):?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-categories-brand single-categories-padding mb-30">
                                <a href="<?= Url::toRoute(['site/list','catalog'=>$cat['id']])?>"><?= $cat['name'] ?></a><!-- <img class="inject-me" src="images/icon-img/gadget.svg" alt=""> -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div id="categories-brand-2" class="tab-pane">
                <div class="row">
                    <?php foreach ($brands as $brand):?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-categories-brand categories-brand-center mb-30">
                                <a href="<?= Url::to(['list','brand'=>$brand->id])?>"><?= $brand->name ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="testimonial-area bg-theme-color-main fix pt-140 pb-140 mb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title-2 st-peragraph-width st-line-height mb-30">
                    <h2>Мы любим наших клиентов, <br>А они любят нас</h2>
                    <p class="st-2-paragraph">Вы также можете смело оставлять отзывы на нашу продукцию на этом сайте или на Яндекс Маркете!</p>
                    <div class="btn-style-2 btn-hover">
                        <a class="animated btn-ptb-1 btn-ptb-2-white-bg" href="https://market.yandex.ru/shop--pechirus/295931/reviews">Все отзывы</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="testimonial-active pl-70">
                    <div class="testimonial-plr-1">
                        <div class="single-testimonial">
                            <div class="testi-rating-quotes-icon">
                                <div class="testi-rating">
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                </div>
                                <div class="testi-quotes-icon">
                                    <img class="inject-me" src="<?=Url::to('@web/site/')?>images/icon-img/quotes-icon.png" alt="">
                                </div>
                            </div>
                            <p>Достоинства: Большой выбор печей по адекватной цене. Важно,что все выполнено по договору и с гарантией.Цена после установки осталась как договаривались изначально.
                                Недостатки: Практически нет.
                                Комментарий: Хотим поблагодарить Алексея и его напарника за установку печи Гуча.Все выполнили за один день,все сделано добросовестно,качественно.Сами доставили,разгрузили и установили.Очень помогли с установкой фанеры и плитки под печь.Дали подробные рекомендации как топить.Мы очень довольны и печью, и работой ребят. СПАСИБО ОГРОМНОЕ АЛЕКСЕЮ.Рекомендую этот магазин и ребят- славян,которые все делают профессионально и добросовестно.</p>
                            <div class="client-info-wrap">
                                <div class="client-info">
                                    <h3>Наталья Ш.</h3>
                                    <span>Яндекс маркет</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-plr-1">
                        <div class="single-testimonial">
                            <div class="testi-rating-quotes-icon">
                                <div class="testi-rating">
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                </div>
                                <div class="testi-quotes-icon">
                                    <img class="inject-me" src="<?=Url::to('@web/site/')?>images/icon-img/quotes-icon.png" alt="">
                                </div>
                            </div>
                            <p>Большое спасибо за очень емкую консультацию в самом начале общения по планируемой покупке отопительного котла. Как всегда в этих вопросах очень много нюансов, а когда планируешь такие серьёзные вещи как отопление, то важна каждая мелочь. Доставку также компетентно продумали и осуществили.</p>
                            <div class="client-info-wrap">
                                <div class="client-info">
                                    <h3>Роман Ж.</h3>
                                    <span>Яндекс маркет</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-plr-1">
                        <div class="single-testimonial">
                            <div class="testi-rating-quotes-icon">
                                <div class="testi-rating">
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                    <i class="icon-rating"></i>
                                </div>
                                <div class="testi-quotes-icon">
                                    <img class="inject-me" src="<?=Url::to('@web/site/')?>images/icon-img/quotes-icon.png" alt="">
                                </div>
                            </div>
                            <p>Долго мониторил и мониторил и присматривался к магазинам и ценам на печи и в интернете подвернулся считаю очень хороший вариант покупки в профессиональном магазине Печи рус. Заказал всё необходимое оборудование с доставкой. К доставке нет претензий.</p>
                            <div class="client-info-wrap">
                                <div class="client-info">
                                    <h3>Михаил А.</h3>
                                    <span>Яндекс маркет</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="subscribe-area pt-150 pb-115">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-title st-peragraph-width st-line-height mb-30">
                    <h2>Subscribe for getting offer <br>& News Letters</h2>
                    <p>Dramatically iterate revolutionary infomediaries before 2.0 customer service</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div id="mc_embed_signup" class="subscribe-form-2 mt-30">
                    <form id="mc-embedded-subscribe-form" class="validate subscribe-form-style-2" novalidate="" target="_blank" name="mc-embedded-subscribe-form" method="post" action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef">
                        <div id="mc_embed_signup_scroll" class="mc-form-2">
                            <input class="email" type="email" required="" placeholder="Enter email address" name="EMAIL" value="">
                            <div class="mc-news-2" aria-hidden="true">
                                <input type="text" value="" tabindex="-1" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef">
                            </div>
                            <div class="clear-2">
                                <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="Subscribe">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
