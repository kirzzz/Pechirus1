<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Basket;
use app\models\Catalog;
use app\models\Product;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-198532627-1">
        </script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-198532627-1');
        </script>
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(31050401, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/31050401" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <div class="main-wrapper main-wrapper-3">
        <header class="header-area section-padding-1 transparent-bar">
            <div class="header-large-device">
                <div class="header-top bg-gray-4 header-top-ptb-1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="header-contact-number">
                                    <span>+7 (495) 540-47-03</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="header-top-right header-top-flex">
                                    <div class="login-reg ml-40">
                                        <ul>
                                            <?php if(Yii::$app->user->isGuest):?>
                                                <li><a href="<?= Url::toRoute(['site/login'])?>">Войти</a></li>
                                                <li><a href="<?= Url::toRoute(['site/login'])?>">Создать аккаунт</a></li>
                                            <?php else:?>
                                                <?php $user = \app\models\User::findIdentity(Yii::$app->user->id) ?>
                                                <li><a href="<?= Url::toRoute(['site/login'])?>">Здравствуйте, <?= $user->name?$user->name:$user->username ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom sticky-bar">
                    <div class="container-fluid pt-4">
                        <div class="header-bottom-flex">
                            <div class="logo-menu-wrap">
                                <div class="logo">
                                    <a style="max-width: 100%" href="<?=Url::to('index')?>">
                                        <img style="max-width: 100%;height: auto;max-height: 47px;" src="<?=Url::to('@web/')?>logo-dark.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="header-action-wrap header-action-flex header-action-width">
                                <div class="search-style-2 mx-auto">
                                    <?php \yii\widgets\ActiveForm::begin(['action' => Url::toRoute(['site/list']),'method' => 'get']) ?>
                                    <div class="form-search-2">
                                        <input class="input-text" value="" name="main-data" placeholder="Введите данные" type="search">
                                        <button type="submit">
                                            <i class="icofont-search-1"></i>
                                        </button>
                                    </div>
                                    <?php \yii\widgets\ActiveForm::end() ?>
                                </div>
                                <div class="tel mr-3">
                                    <a href="tel:84955404703"><i class="icofont-telephone mr-2"></i>+7 (495) 540-47-03</a>
                                </div>
                                <div class="same-style ml-2 header-cart">
                                    <a href="<?=Url::toRoute(['site/user'])?>"><i class="icofont-user-alt-3"></i></a>
                                </div>
                                <div class="same-style ml-2 header-cart">
                                    <a href="<?=Url::toRoute(['site/wishlist'])?>"><i class="icofont-heart"></i></a>
                                </div>
                                <div class="same-style ml-2 header-cart">
                                    <a href="<?=Url::toRoute(['site/compare'])?>"><i class="icon-compare"></i></a>
                                </div>
                                <div class="same-style ml-2 header-cart">
                                    <a class="cart-active" href="javascript:void(0)"><i class="icofont-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="main-menu menu-lh-1 main-menu-padding-1">
                                <nav>
                                    <ul>
                                        <li>
                                            <div class="cd-dropdown-wrapper">
                                                <a class="cd-dropdown-trigger" href="#0"><i class="icofont-listing-box mr-2"></i>Каталог</a>
                                                <nav class="cd-dropdown">
                                                    <h2>Каталог</h2>
                                                    <a href="#0" class="cd-close">Закрыть</a>
                                                    <ul class="cd-dropdown-content">
                                                        <li>
                                                            <form class="cd-search">
                                                                <input type="search" placeholder="Поиск...">
                                                            </form>
                                                        </li>
                                                        <?php
                                                        $catalogs = Catalog::find()->where(['status'=>Catalog::STATUS_ACTIVE])->asArray()->all();
                                                        function CreateTree($array,$sub=0){
                                                            $a = array();
                                                            foreach($array as $v) {
                                                                if($sub == $v['idParent']) {
                                                                    $b = CreateTree($array,$v['article']);
                                                                    if(!empty($b))
                                                                        $a[$v['article']] = $b;
                                                                    else
                                                                        $a[$v['article']] = $v['name'];
                                                                }
                                                            }
                                                            return $a;
                                                        }
                                                        function showTree($arr,$data, $lvl = 0){
                                                            if($lvl < 2) {
                                                                foreach ($arr as $key => $v) {
                                                                    $item = $data[array_search($key, array_column($data, 'article'))];
                                                                    echo '<li class="' . ((is_array($v) and $lvl < 1) ? "has-children" : "") . ' ">
                                                                        <a href="' . Url::toRoute(['site/list', 'catalog' => $item['id']]) . '">' . $item['name'] . '</a>';
                                                                    if (!is_array($v) or $lvl > 0) {
                                                                        echo '</li>';
                                                                    } else {
                                                                        echo '<ul class="cd-dropdown-icons is-hidden">
                                                                                <li class="go-back"><a href="#0">Назад</a></li>
                                                                                <li class="see-all">
                                                                                    <a href="' . Url::toRoute(['site/list', 'catalog' => $item['id']]) . '">Все ' . $item['name'] . '</a>
                                                                                </li>';
                                                                        echo showTree($v, $data, $lvl + 1);
                                                                        echo '</ul>
                                                                        </li>';
                                                                        //(!is_array($v)?Url::toRoute(['site/list','catalog'=>$item['id']]):( $lvl <= 1 ? Url::toRoute(['site/list','catalog'=>$item['id']]):"#0"))
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        $tree = CreateTree($catalogs);
                                                        showTree($tree,$catalogs);
                                                        ?>
                                                    </ul>
                                                    <!-- .cd-dropdown-content -->
                                                </nav>
                                                <!-- .cd-dropdown -->
                                            </div>
                                        </li>
                                        <li><a href="<?=Url::toRoute(['site/about-us'])?>">О нас</a></li>
                                        <li><a href="<?=Url::toRoute(['site/contact'])?>">Контакты</a></li>
                                        <li><a href="<?=Url::toRoute(['site/payment-and-delivery'])?>">Оплата и Доставка</a></li>
                                        <li><a href="<?=Url::toRoute(['site/order-tracking'])?>">Отследить заказ</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-small-device header-small-ptb sticky-bar">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="mobile-logo mobile-logo-width">
                                <a href="<?=Url::current()?>">
                                    <img height="47" src="<?=Url::to('@web/')?>logo-dark.png" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="header-action-wrap header-action-flex header-action-mrg-1">
                                <div class="cd-dropdown-wrapper">
                                    <a class="cd-dropdown-trigger" href="#0"><i class="icofont-listing-box mr-2"></i></a>
                                    <nav class="cd-dropdown">
                                        <h2>Каталог</h2>
                                        <a href="#0" class="cd-close">Закрыть</a>
                                        <ul class="cd-dropdown-content">
                                            <li>
                                                <form class="cd-search">
                                                    <input type="search" placeholder="Поиск...">
                                                </form>
                                            </li>
                                            <?php
                                            $tree = CreateTree($catalogs);
                                            showTree($tree,$catalogs);
                                            ?>
                                        </ul>
                                        <!-- .cd-dropdown-content -->
                                    </nav>
                                    <!-- .cd-dropdown -->
                                </div>
                                <div class="same-style header-cart ml-2">
                                    <a class="cart-active" href="javascript:void(0)"><i class="icofont-shopping-cart"></i></a>
                                </div>
                                <div class="same-style header-info">
                                    <button class="mobile-menu-button-active">
                                        <span class="info-width-1"></span>
                                        <span class="info-width-2"></span>
                                        <span class="info-width-3"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- mini cart start -->
        <div class="sidebar-cart-active">
            <div class="sidebar-cart-all">
                <a class="cart-close" href="javascript:void(0)"><i class="icofont-close-line"></i></a>
                <div class="cart-content">
                    <h3>Корзина покупок</h3>
                    <ul id="basket-mini-helper">
                        <?php
                        if(!Yii::$app->user->isGuest){
                            $basket = Basket::find()->where(['idUser'=>Yii::$app->user->id])->andWhere(['status'=>Basket::STATUS_ADD])->all();
                            if(!empty($basket)){
                                $products = Product::find()->where(['in','id',array_column($basket,'idProduct')])->all();
                            }
                        }else{
                            $session = Yii::$app->session;
                            if(!$session->isActive)
                                $session->open();
                            $basket = [];
                            if (!$session->has('basket'))
                                $session->set('basket', $basket);
                            else
                                $basket = $session->get('basket');
                            if(!empty($basket)){
                                $products = Product::find()->where(['in','id',array_column($basket,'idProduct')])->all();
                            }
                        }
                        $price = 0;
                        ?>
                        <?php if(isset($products) and !empty($products)): foreach ($products as $product): $price+=$product->new_price?$product->new_price:$product->price;?>
                            <li class="single-product-cart">
                                <div class="cart-img"><a href="javascript:void(0)"><img src="/<?=($product->img !== '[]'?json_decode($product->img,true)[0]['path']:"images/default/no-image.png")?>" alt=""></a></div>
                                <div class="cart-title"><h4><a href="javascript:void(0)"><?=$product->name?></a></h4><span>&#8381; <?= ($product->new_price?$product->new_price:$product->price) ?></span></div>
                                <div class="cart-delete"><a href="javascript:void(0)" data-basket-mini-type="basket" data-basket-mini-delete="<?=$product->id?>">×</a></div>
                            </li>
                        <?php endforeach;endif;?>
                    </ul>
                    <div class="cart-total">
                        <h4>Общая сумма: &#8381;<span id="basket-mini-helper-total-price"><?= $price ?></span></h4>
                    </div>
                    <div class="cart-checkout-btn">
                        <a class="btn-hover cart-btn-style" href="<?= Url::toRoute(['site/basket']) ?>">В корзину</a>
                        <a class="no-mrg btn-hover cart-btn-style" href="<?= Url::toRoute(['site/order']) ?>">Заказать</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile menu start -->
        <div class="mobile-menu-active clickalbe-sidebar-wrapper-style-1">
            <div class="clickalbe-sidebar-wrap">
                <a class="sidebar-close"><i class="icofont-close-line"></i></a>
                <div class="mobile-menu-content-area sidebar-content-100-percent">
                    <div class="mobile-search">
                        <div class="d-flex justify-content-start mb-2">
                            <a href="<?= Url::toRoute(['site/login'])?>">Войти / Создать аккаунт</a>
                        </div>
                        <?php \yii\widgets\ActiveForm::begin(['action' => Url::toRoute(['site/list']),'method' => 'get','options' => ['class'=>'search-form']]) ?>
                        <input type="text" placeholder="Введите данные" name="main-data">
                        <button class="button-search"><i class="icofont-search-1"></i></button>
                        <?php \yii\widgets\ActiveForm::end() ?>
                    </div>
                    <div class="clickable-mainmenu-wrap clickable-mainmenu-style1">
                        <nav>
                            <ul>
                                <li><a href="<?=Url::toRoute(['site/about-us'])?>">О нас</a></li>
                                <li><a href="<?=Url::toRoute(['site/contact'])?>">Контакты</a></li>
                                <li><a href="<?=Url::toRoute(['site/payment-and-delivery'])?>">Оплата и Доставка</a></li>
                                <li><a href="<?=Url::toRoute(['site/order-tracking'])?>">Отследить заказ</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="aside-contact-info">
                        <ul>
                            <li>
                                <div class="header-action-wrap header-action-flex header-action-mrg-1">
                                    <div class="same-style header-cart ml-0">
                                        <a href="<?=Url::toRoute(['site/user'])?>"><i class="icofont-user-alt-3 m-0"></i></a>
                                    </div>
                                    <div class="same-style ml-2 header-cart">
                                        <a href="<?=Url::toRoute(['site/wishlist'])?>"><i class="icofont-heart m-0"></i></a>
                                    </div>
                                    <div class="same-style ml-2 header-cart">
                                        <a href="<?=Url::toRoute(['site/compare'])?>"><i class="icon-compare m-0"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li><i class="icofont-clock-time"></i>Пн-Пт с 10:00 до 18:00 Сб-Вс с 10:00 до 15:00</li>
                            <li><i class="icofont-envelope"></i>pechirus@gmail.com, info@pechirus.ru</li>
                            <li><i class="icofont-stock-mobile"></i>+7 (495) 540-47-03</li>
                            <li><i class="icofont-home"></i>МКАД 92км, Мытищи ул. Красный поселок, д.2a, ТЦ Садовод Линия Е, павильоны №47-48</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?= $content ?>
        <footer class="footer-area pt-70">
            <div class="footer-top pb-70">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-title-2"><a href="https://www.instagram.com/pechirus/">Instagram</a></h3>
                                <div class="instagram-feed-area mr-40">
                                    <div class="instagram-wrap-1">
                                        <div class="single-instafeed-wrap">
                                            <div class="single-instafeed">
                                                <a href="https://www.instagram.com/pechirus/"><img style="width: 73px; height: 73px; object-fit: cover" src="<?=Url::to('@web/site/')?>images/instafeed/117766958_307184353827559_840108583749763090_n.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="single-instafeed-wrap">
                                            <div class="single-instafeed">
                                                <a href="https://www.instagram.com/pechirus/"><img style="width: 73px; height: 73px; object-fit: cover" src="<?=Url::to('@web/site/')?>images/instafeed/120317876_134980311643406_334110960282974303_n.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="single-instafeed-wrap">
                                            <div class="single-instafeed">
                                                <a href="https://www.instagram.com/pechirus/"><img style="width: 73px; height: 73px; object-fit: cover" src="<?=Url::to('@web/site/')?>images/instafeed/122270911_1388422351549241_4719603651279124060_n.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="single-instafeed-wrap">
                                            <div class="single-instafeed">
                                                <a href="https://www.instagram.com/pechirus/"><img style="width: 73px; height: 73px; object-fit: cover" src="<?=Url::to('@web/site/')?>images/instafeed/123020422_1042854812824921_5601226964226339382_n.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="single-instafeed-wrap">
                                            <div class="single-instafeed">
                                                <a href="https://www.instagram.com/pechirus/"><img style="width: 73px; height: 73px; object-fit: cover" src="<?=Url::to('@web/site/')?>images/instafeed/129775919_1071671603281860_4378014989695971864_n.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="single-instafeed-wrap">
                                            <div class="single-instafeed">
                                                <a href="https://www.instagram.com/pechirus/"><img style="width: 73px; height: 73px; object-fit: cover" src="<?=Url::to('@web/site/')?>images/instafeed/133758313_122156829741458_1903997683732672859_n.jpg" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-title-2">О нас</h3>
                                <div class="footer-info-list-2">
                                    <ul>
                                        <li><a href="<?= Url::toRoute(['site/about-us'])?>">О нас</a></li>
                                        <li><a href="<?= Url::toRoute(['site/contact'])?>">Контакты</a></li>
                                        <li><a href="<?= Url::toRoute(['site/payment-and-delivery'])?>">Оплата и Доставка</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-title-2">Популярные категории продуктов</h3>
                                <div class="footer-info-list-2">
                                    <ul>
                                        <li><a href="<?= Url::toRoute(['site/list','name'=>'Камины'])?>">Камины</a></li>
                                        <li><a href="<?= Url::toRoute(['site/list','name'=>'Тандыры'])?>">Тандыры</a></li>
                                        <li><a href="<?= Url::toRoute(['site/list','name'=>'Котлы'])?>">Котлы</a></li>
                                        <li><a href="<?= Url::toRoute(['site/list','name'=>'Дымоходы'])?>">Дымоходы</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-title-2">Связаться с нами</h3>
                                <div class="footer-connect">
                                    <p>МКАД 92км, Мытищи ул. Красный поселок, д.2a, ТЦ Садовод Линия Е, павильоны №47-48</p>
                                    <a href="javascript:void(0)">pechirus@gmail.com,  info@pechirus.ru</a>
                                    <a href="javascript:void(0)">+7 (495) 540-47-03</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom border-top-2 copyright-ptb-2">
                <div class="container">
                    <div class="row align-items-center">
                        <!--<div class="col-xl-4 col-lg-3 col-md-12">
                            <div class="footer-menu">
                                <nav>
                                    <ul>
                                        <li><a href="javascript:void(0)">Terms</a></li>
                                        <li><a href="javascript:void(0)">Privacy</a></li>
                                        <li><a href="javascript:void(0)">License</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="copyright-2 text-center">
                                <p>Copyright © 2021 Pechirus - Все права защищены</p>
                                <p>ИП Кулаков Антон Валентинович ОГРНИП:314774603400845</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-12">
                            <div class="social-icon social-icon-right">
                                <a href="https://www.instagram.com/pechirus/"><i class="icon-social-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div style="display: none; height: auto" id="modal-helper" class="<?= (Yii::$app->session->hasFlash('success')?'success':'').(Yii::$app->session->hasFlash('error')?'error':'') ?>">
            <p class="<?= (Yii::$app->session->hasFlash('success')?'success':'').(Yii::$app->session->hasFlash('error')?'error':'') ?> mb-0">
                <?= Yii::$app->session->getFlash('error') ?>
                <?= Yii::$app->session->getFlash('success') ?>
            </p>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-12 col-sm-6">
                                <div class="quickview-img">
                                    <img src="<?=Url::to('@web/site/')?>images/product/product-3.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-12 col-sm-6">
                                <div class="product-details-content quickview-content">
                                    <h2>Electronic Shop</h2>
                                    <div class="product-ratting-review-wrap">
                                        <div class="product-ratting-digit-wrap">
                                            <div class="product-ratting">
                                                <i class="icon-rating"></i>
                                                <i class="icon-rating"></i>
                                                <i class="icon-rating"></i>
                                                <i class="icon-rating"></i>
                                                <i class="icon-star-empty"></i>
                                            </div>
                                            <div class="product-digit">
                                                <span>4.0</span>
                                            </div>
                                        </div>
                                        <div class="product-review-order">
                                            <span>62 Reviews</span>
                                            <span>242 orders</span>
                                        </div>
                                    </div>
                                    <p>Seamlessly predominate enterprise metrics without performance based process improvements.</p>
                                    <div class="pro-details-price">
                                        <span>US $75.72</span>
                                        <span class="old-price">US $95.72</span>
                                    </div>
                                    <div class="pro-details-color-wrap">
                                        <span>Color:</span>
                                        <div class="pro-details-color-content">
                                            <ul>
                                                <li><a class="white" href="javascript:void(0)">Black</a></li>
                                                <li><a class="azalea" href="javascript:void(0)">Blue</a></li>
                                                <li><a class="dolly" href="javascript:void(0)">Green</a></li>
                                                <li><a class="peach-orange" href="javascript:void(0)">Orange</a></li>
                                                <li><a class="mona-lisa active" href="javascript:void(0)">Pink</a></li>
                                                <li><a class="cupid" href="javascript:void(0)">gray</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pro-details-size">
                                        <span>Size:</span>
                                        <div class="pro-details-size-content">
                                            <ul>
                                                <li><a href="javascript:void(0)">XS</a></li>
                                                <li><a href="javascript:void(0)">S</a></li>
                                                <li><a href="javascript:void(0)">M</a></li>
                                                <li><a href="javascript:void(0)">L</a></li>
                                                <li><a href="javascript:void(0)">XL</a></li>
                                                <li><a href="javascript:void(0)">XXL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pro-details-quality">
                                        <span>Quantity:</span>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                        </div>
                                    </div>
                                    <div class="product-details-meta">
                                        <ul>
                                            <li><span>Model:</span> <a href="javascript:void(0)">Odsy-1000</a></li>
                                            <li><span>Ship To</span> <a href="javascript:void(0)">2834 Laurel Lane</a>, <a href="javascript:void(0)">Mentone</a> , <a href="javascript:void(0)">Texas</a></li>
                                        </ul>
                                    </div>
                                    <div class="pro-details-action-wrap">
                                        <div class="pro-details-buy-now">
                                            <a href="javascript:void(0)">Buy Now</a>
                                        </div>
                                        <div class="pro-details-action">
                                            <a title="Add to Cart" href="javascript:void(0)"><i class="icon-basket"></i></a>
                                            <a title="Add to Wishlist" href="javascript:void(0)"><i class="icon-heart"></i></a>
                                            <a class="social" title="Social" href="javascript:void(0)"><i class="icon-share"></i></a>
                                            <div class="product-dec-social">
                                                <a class="facebook" title="Facebook" href="javascript:void(0)"><i class="icon-social-facebook-square"></i></a>
                                                <a class="twitter" title="Twitter" href="javascript:void(0)"><i class="icon-social-twitter"></i></a>
                                                <a class="instagram" title="Instagram" href="javascript:void(0)"><i class="icon-social-instagram"></i></a>
                                                <a class="pinterest" title="Pinterest" href="javascript:void(0)"><i class="icon-social-pinterest"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
    </div>
    <input type="hidden" id="url-basket" data-basket-mini-url="<?= Url::toRoute(['site/basket-mini',true])?>" data-basket-mini-remove-url="<?= Url::toRoute(['site/basket-mini-remove',true])?>">
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>