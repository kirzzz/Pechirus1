<?php
/* @var $this yii\web\View */
/* @var $products \app\models\Product[] */
/* @var $catalogs Catalog */
/* @var $brands \app\models\Brand[] */
/* @var $pages */

use app\models\Basket;
use app\models\Catalog;
use app\models\Compare;
use app\models\Wishlist;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$get = Yii::$app->request->get();

$new_catalog = \yii\helpers\ArrayHelper::map((array)$catalogs,'article','name','idParent');
$helper_catalog = (isset($get['catalog'])?($catalogs[array_search($get['catalog'],array_column((array)$catalogs,'id'))]['name']):'Каталог');
$this->title = 'ПечиРус - '.$helper_catalog . '. Страница - '.($pages->page + 1);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'ПечиРус, Pechirus, Печи, '.implode(',',explode(' ',$helper_catalog))]);
$this->registerMetaTag(['name' => 'description', 'content' => 'Печи в Москве от надежных поставщиков по низким ценам с гарантией. Телефон для консультации +7 (495) 540-47-03. Печи, Котлы, Дымоходы и аксессуары для бани и сауны. Более 3-х тысяч товаров.'.$helper_catalog]);
$this->params['breadcrumbs'][] = $this->title;

$catalog_name = '<p>Печи, Котлы, Дымоходы и аксессуары для бани и сауны</p>';
if(isset($get['catalog'])){
    $catalogs_id = Catalog::getTreeTop($get['catalog']);
    if(!empty($catalogs_id)){
        $catalog_name = '<ul>';
        foreach ($catalogs_id as $index =>$cat_id){
            $cat = Catalog::find()->where(['id'=>$cat_id])->one();
            if($index == (count($catalogs_id) - 1))
                $catalog_name .= '<li class="active">'.$cat->name.'</li>';
            else
                $catalog_name .= '<li><a href="'.(Url::toRoute(['site/list','catalog'=>$cat->id])).'">'.$cat->name.'</a></li><li><span> > </span></li>';
        }
        $catalog_name .= '</ul>';
    }
}
?>
<div class="breadcrumb-area breadcrumb-mt bg-gray breadcrumb-ptb-1">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Каталог</h2>
            <?= $catalog_name ?>
        </div>
    </div>
</div>
<div class="shop-area pt-160 pb-160 section-padding-12">
    <div class="container-fluid">
        <div class="row flex-row-reverse">
            <div class="col-xl-9 col-lg-8">
                <div class="shop-img-slider-section">
                    <div class="shop-top-bar" style="flex-wrap: wrap;">
                        <div class="shop-filter mb-2">
                            <a class="shop-filter-active" href="#">Фильтры<i class="icofont-filter ml-2"></i></a>
                        </div>
                        <div class="shop-top-bar-left mb-2">
                            <div class="shop-tab nav">
                                <a href="#shop-1" class="active" data-toggle="tab"><img class="inject-me" src="<?= Url::to('@web/site/')?>images/icon-img/shop-grid.svg" alt=""></a>
                                <a href="#shop-2" data-toggle="tab"><img class="inject-me" src="<?= Url::to('@web/site/')?>images/icon-img/shop-list.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="shop-top-bar-left mb-2">
                            <div class="shop-tab nav">
                                <a href="<?= Url::current(['price'=>'ASC'])?>" class="<?= (isset($get['price']) and $get['price']=='ASC')?'active':'' ?>"><i class="icofont-rouble"></i><i class="icofont-arrow-up"></i></a>
                                <a href="<?= Url::current(['price'=>'DESC'])?>" class="<?= (isset($get['price']) and $get['price']=='DESC')?'active':'' ?>"><i class="icofont-rouble"></i><i class="icofont-arrow-down"></i></a>
                            </div>
                        </div>
                        <div class="shop-top-bar-right mb-2">
                            <a class="" href="<?= Url::toRoute(['site/list'])?>">Очистить фильтр<i class="icofont-filter ml-2"></i></a>
                        </div>
                    </div>
                    <div class="product-filter-wrapper my-filter">
                        <div class="row">
                            <div class="custom-col-5-2">
                                <div class="sidebar-widget-3 mb-50">
                                    <h4 class="pro-sidebar-title-3">Категории<a class="shop-filter-active" href="#"><i class="icofont-close"></i></a></h4>
                                    <div class="sidebar-widget-categori-3 mt-45" data-catalog-container>
                                        <?php foreach ($new_catalog as $index=>$group):?>
                                            <?php $class = isset($get['catalog'])?(isset($group[$catalogs[array_search($get['catalog'],array_column((array)$catalogs,'id'))]['article']])?'d-flex':'d-none'):($index?'d-none':'d-flex')?>
                                            <ul class="<?= $class ?> flex-column" data-catalog-parent="<?= $index ?>">
                                                <?= $index?'<li class="back"><button data-catalog-back="'.$index.'"><i class="icofont-arrow-left"></i>Назад</button></li>':'' ?>
                                                <?php foreach ($group as $article=>$name):?>
                                                    <li data-catalog-article="<?= $article ?>" class="<?= isset($get['catalog'])?($catalogs[array_search($get['catalog'],array_column((array)$catalogs,'id'))]['article'] == $article?'active':''):'' ?>">
                                                        <a href="<?= Url::current(['catalog'=>$catalogs[array_search($article,array_column((array)$catalogs,'article'))]['id']])?>"><?= $name ?></a><?= isset($new_catalog[$article])?'<button data-catalog-article-open="'.$article.'"><i class="icofont-arrow-right"></i></button>':'' ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5-2">
                                <div class="sidebar-widget mb-50">
                                    <h4 class="pro-sidebar-title">Фильтровать по брэнду</h4>
                                    <div class="sidebar-widget-categori-3 mt-45">
                                        <ul>
                                            <?php foreach ($brands as $brand):?>
                                                <li><a class="white" href="<?= Url::current(['brand'=>$brand->id])?>"><?= $brand->name ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5-2">
                                <div class="sidebar-widget mb-50">
                                    <h4 class="pro-sidebar-title">Фильтровать по цене</h4>
                                    <div class="price-filter price-mrg-none mt-45">
                                        <div id="slider-range"></div>
                                        <div class="price-slider-amount">
                                            <div class="label-input">
                                                <span>Цена: </span><input type="text" id="amount" name="price" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content pt-30">
                        <?php if(!empty($products)):?>
                            <div id="shop-1" class="tab-pane active padding-16-row-col">
                                <div class="row">
                                    <?php foreach($products as $product): ?>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 align-self-end">
                                            <div class="product-wrap mb-50">
                                                <div class="product-img product-img-zoom mb-25 product-img-slider-active dot-style-5">
                                                    <?php $images = $product->img !== '[]'?json_decode($product->img,true):'images/default/no-image.png'?>
                                                    <?php if(is_array($images)):?>
                                                        <?php foreach ($images as $img):?>
                                                            <a href="<?=Url::to(['site/product','id'=>$product->id])?>">
                                                                <img style="max-height: 400px;object-fit: contain;" src="/<?= $img['path'] ?>" alt="">
                                                            </a>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <a href="<?=Url::to(['site/product','id'=>$product->id])?>">
                                                            <img style="max-height: 400px;object-fit: contain;" src="/<?= $images ?>" alt="">
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="product-content">
                                                    <h4><a href="<?=Url::to(['site/product','id'=>$product->id])?>"><?= $product->name ?></a></h4>
                                                    <h4 class="<?= $product->in_stock?'text-success':'' ?>"><?= $product->in_stock?'В наличии':'Под заказ' ?></h4>
                                                    <h4>Артикул: <?= $product->article ?></h4>
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
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div id="shop-2" class="tab-pane ">
                                <?php foreach($products as $product): ?>
                                    <div class="shop-list-wrap mb-50">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="product-list-img">
                                                    <?php $images = $product->img !== '[]'?json_decode($product->img,true)[0]['path']:'images/default/no-image.png'?>
                                                    <a href="<?=Url::to(['site/product','id'=>$product->id])?>">
                                                        <img style="max-height: 300px; object-fit: contain;" src="/<?= $images ?>" alt="">
                                                    </a>
                                                    <!--<div class="shop-list-quickview">
                                                        <button data-toggle="modal" data-target="#exampleModal"><i class="icon-zoom"></i></button>
                                                    </div>-->
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <div class="shop-list-content ml-20">
                                                    <h3><a href="<?=Url::to(['site/product','id'=>$product->id])?>"><?= $product->name ?></a></h3>
                                                    <h4>Артикул: <?= $product->article ?></h4>
                                                    <h4 class="<?= $product->in_stock?'text-success':'' ?>"><?= $product->in_stock?'В наличии':'Под заказ' ?></h4>
                                                    <div class="pro-list-price">
                                                        <?= $product->new_price?"<span>&#8381;".$product->new_price."</span><span class='old-price'>&#8381; ".$product->price."</span>":"<span>&#8381;".$product->price."</span>" ?>
                                                    </div>
                                                    <p style="max-height: 120px; overflow-y: auto"><?= $product->description? strip_tags($product->description,'<ul><li><br>'):'Описание не указано.' ?></p>
                                                    <div class="product-list-action">
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
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else:?>
                            <h1>Нам не удалось ничего найти.</h1>
                        <?php endif; ?>
                        <div class="pro-pagination-style text-center mt-50 d-flex justify-content-center">
                            <?= LinkPager::widget([
                                'pagination' => $pages ,
                                'activePageCssClass' => 'active',
                                'pageCssClass' => 'mb-2',
                                'firstPageCssClass' => '',
                                'lastPageCssClass' => '',
                                'disableCurrentPageButton' => false,
                                'disabledPageCssClass' => 'mb-2',
                                'firstPageLabel' => '#1',
                                'lastPageLabel' => $pages->pageCount,
                                'prevPageLabel' => '<i class="icofont-long-arrow-left"></i>',
                                'nextPageLabel' => '<i class="icofont-long-arrow-right"></i>',
                                'maxButtonCount' => 7 ,
                                //'linkOptions' => ['class' => 'page-link'],
                                'options' => ['style' => 'flex-wrap: wrap']
                            ] ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="shop-sidebar-style shop-sidebar-style-mrg2">
                    <?php
                    $subcategories = Catalog::find()->where(['status'=> Catalog::STATUS_ACTIVE]);
                    if(isset($get['catalog'])){
                        $this_catalog = Catalog::find()->where(['id'=>$get['catalog']])->one();
                        $subcategories = $subcategories->andWhere(['idParent'=>$this_catalog->article])->all();
                        if(empty($subcategories)){
                            $subcategories = Catalog::find()->where(['status'=> Catalog::STATUS_ACTIVE])->andWhere(['idParent'=>$this_catalog->idParent])->all();
                        }
                    }else{
                        $subcategories = $subcategories->andWhere(['idParent' => null])->all();
                    }
                    ?>
                    <?php if(!empty($subcategories)): ?>
                    <div class="sidebar-widget">
                        <h4 class="pro-sidebar-title">Подкатегории</h4>
                        <div class="sidebar-widget-categori mt-45 mb-70">
                            <ul>
                                <?php //isset($subcategories[0]->idParent)?"<li><a href=". Url::current(['catalog'=>(Catalog::find()->where(['article'=>$subcategories[0]->idParent])->one())->id]) .">Назад</a></li>":""?>
                                <?php foreach ($subcategories as $category):?>
                                <li><a class="<?= (isset($get['catalog']) and $get['catalog'] == $category->id)?"active":"" ?>" href="<?= Url::current(['catalog'=>$category->id]) ?>"><?= $category->name ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>

    </div>
</div>