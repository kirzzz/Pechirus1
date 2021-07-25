<?php

/* @var $this yii\web\View */
/* @var $data app\models\Product[] */
/* @var $data_catalog app\models\Catalog[] */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\assets\Select2Asset;
use yii\widgets\LinkPager;

Select2Asset::register($this);
\app\assets\XEditableAsset::register($this);

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;

$new_catalog = \yii\helpers\ArrayHelper::map((array)$data_catalog,'article','name','idParent');
?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Главная</a></li>
                        <li class="breadcrumb-item active">Продукты</li>
                    </ol>
                </div>
                <h4 class="page-title">Продукты</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-10 col-md-12">
                        <?php ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'form-inline'], 'method'=>'get','action' => Url::to('products')]) ?>
                            <?php $get = Yii::$app->request->get()?>
                            <div class="form-group col-lg-3 col-sm-12 mb-sm-1 mb-lg-0 p-sm-0 px-lg-1">
                                <label for="inputData" class="sr-only">Поиск</label>
                                <input type="search" name="data" value="<?= isset($get['data'])?$get['data']:'' ?>" class="form-control col-md-12" id="inputData" placeholder="Поиск...">
                            </div>
                            <div class="form-group col-lg-3 col-sm-12 mb-sm-1 mb-lg-0 p-sm-0 px-lg-1">
                                <select class="custom-select col-sm-12" id="status-select" name="order">
                                    <option selected="" value="">Все</option>
                                    <option <?= (isset($get['order']) and $get['order'] == 1)?'selected="selected"':'' ?> value="1">Популярные</option>
                                    <option <?= (isset($get['order']) and $get['order'] == 2)?'selected="selected"':'' ?> value="2">Цена по убыванию</option>
                                    <option <?= (isset($get['order']) and $get['order'] == 3)?'selected="selected"':'' ?> value="3">Цена по возрастанию</option>
                                    <option <?= (isset($get['order']) and $get['order'] == 4)?'selected="selected"':'' ?> value="4">Распродано</option>
                                    <option <?= (isset($get['order']) and $get['order'] == 5)?'selected="selected"':'' ?> value="5">Скрытые</option>
                                    <option <?= (isset($get['order']) and $get['order'] == 6)?'selected="selected"':'' ?> value="6">Активные</option>
                                    <option <?= (isset($get['order']) and $get['order'] == 7)?'selected="selected"':'' ?> value="7">Со скидкой</option>
                                    <option <?= (isset($get['order']) and $get['order'] == 6)?'selected="selected"':'' ?> value="8">FBS</option>
                                    <option <?= (isset($get['order']) and $get['order'] == 7)?'selected="selected"':'' ?> value="9">Avito</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-sm-12 mb-sm-1 mb-lg-0 p-sm-0 px-lg-1" id="collapseProductDescParent">
                                <div class="input-group w-100 d-flex flex-nowrap">
                                    <select data-toggle="select2" class="custom-select" name="catalog" id="select-category">
                                        <option selected="" value="">Все</option>
                                        <?php foreach ($data_catalog as $catalog_opt):?>
                                            <option <?= (isset($get['catalog']) and $get['catalog'] == $catalog_opt->id)?'selected="selected"':'' ?>value="<?= $catalog_opt->id ?>"><?= $catalog_opt->name ?></option>
                                        <?php endforeach; ?>
                                        <?/*= showTree(CreateTree($data_catalog),$data_catalog) */?>
                                    </select>
                                    <div class="input-group-append">
                                        <a data-toggle="collapse" href="#collapseProductDesc" aria-expanded="false" aria-controls="collapseProductDesc" class="btn btn-outline-light waves-effect waves-light" type="button">
                                            <i class="fal fa-arrow-to-bottom"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-1 offset-lg-1 col-sm-12 text-lg-left mb-sm-1 mb-lg-0 p-sm-0 px-lg-1">
                                <button type="submit" class="btn btn-success btn-block waves-effect waves-light"><i class="mdi mdi-search-web"></i></button>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="<?= Url::toRoute('admin/product') ?>" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i> Создать</a>
                        </div>
                    </div>
                    <div class="col-12 collapse mt-2" data-catalog-container id="collapseProductDesc" aria-labelledby="headingFour" data-parent="#collapseProductDescParent">
                        <?php foreach ($new_catalog as $index=>$group):?>
                            <?php $class = isset($get['catalog'])?(isset($group[$data_catalog[array_search($get['catalog'],array_column((array)$data_catalog,'id'))]['article']])?'':'d-none'):($index?'d-none':'')?>
                            <ul class="list-unstyled megamenu-list <?= $class ?>" data-catalog-parent="<?= $index ?>">
                                <?= $index?'<li class="back"><button class="btn btn-xs btn-outline-info waves-effect waves-light" type="button" data-catalog-back="'.$index.'"><i class="fal fa-arrow-to-left"></i>Назад</button></li>':'' ?>
                                <?php foreach ($group as $article=>$name):?>
                                    <li data-catalog-article="<?= $article ?>" class="<?= isset($get['catalog'])?($data_catalog[array_search($get['catalog'],array_column((array)$data_catalog,'id'))]['article'] == $article?'active':''):'' ?>">
                                        <a href="" data-catalog-click="<?= $data_catalog[array_search($article,array_column((array)$data_catalog,'article'))]['id'] ?>">
                                            <?= $name ?>
                                        </a>
                                        <?= isset($new_catalog[$article])?'<button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light" data-catalog-article-open="'.$article.'"><i class="fal fa-arrow-to-right"></i></button>':'' ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endforeach; ?>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end card-box -->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <?php if(isset($data) and !empty($data)): foreach ($data as $index => $product):?>
        <?= ($index%4==0 and $index!=0)?'</div>':''?>
        <?= $index%4==0?'<div class="row">':''?>
        <div class="col-md-6 col-xl-3">
            <div class="card-box product-box">
                <div class="product-action">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-xs waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                        <div class="dropdown-menu float-end">
                            <a class="dropdown-item" href="javascript:void(0)" data-admin-functions="add-to-trading-platform" data-steal-compare-id="<?= $product->id ?>" data-steal-type="<?= \app\models\AvitoToProduct::isProductActive($product->id)?'avito-delete':'avito' ?>">
                                <?= \app\models\AvitoToProduct::isProductActive($product->id)?'Удалить из Avito':'Добавить в Avito' ?>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" data-admin-functions="add-to-trading-platform" data-steal-compare-id="<?= $product->id ?>" data-steal-type="<?= \app\models\FbsToProduct::isProductActive($product->id)?'fbs-delete':'fbs' ?>">
                                <?= \app\models\FbsToProduct::isProductActive($product->id)?'Удалить из FBS':'Добавить в FBS' ?>
                            </a>
                        </div>
                    </div>
                    <a href="<?= Url::to(['admin/product','id'=>$product->id]) ?>" class="btn btn-success btn-xs waves-effect waves-light"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript: void(0);" data-admin-functions="delete-product" data-steal-compare-id="<?= $product->id ?>" class="btn btn-danger btn-xs waves-effect waves-light"><i class="mdi mdi-close"></i></a>
                </div>
                <div class="bg-light">
                    <img style="width: 100%;object-fit: contain; height: 230px" src="/<?= $product->img !== '[]'?json_decode($product->img,true)[0]['path']:'images/default/no-image.png'?>" alt="product-pic" class="img-fluid" />
                </div>
                <div class="product-info">
                    <div class="row align-items-start">
                        <div class="col">
                            <h5 class="font-16 mt-0"><a href="<?= Url::toRoute(['site/product','id'=>$product->id]) ?>" class="text-dark"><?= $product->name ?></a> </h5>
                            <div class="text-warning mb-2 font-13">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h5 class="mb-1">
                                <span class="text-muted">
                                    В наличии : <span style="color:#ffffff;" data-type="select" data-parameter="in_stock" data-source="[{value: 0, text: 'Нет'},{value: 1, text: 'Да'}]" data-fast-edit-field="<?= $product->id ?>"><?= $product->in_stock?'Да':'Нет' ?></span>
                                </span>
                            </h5>
                            <h5 class="mb-1">
                                <span class="text-muted">
                                    Скрыт : <span style="color:#ffffff;" data-type="select" data-parameter="hidden" data-source="[{value: 0, text: 'Нет'},{value: 1, text: 'Да'}]" data-fast-edit-field="<?= $product->id ?>"><?= $product->hidden?'Да':'Нет' ?></span>
                                </span>
                            </h5>
                            <h5 class="mb-1">
                                <span class="text-muted">
                                    Осталось : <span style="color:#ffffff;" data-type="text" data-parameter="count" data-source="" data-fast-edit-field="<?= $product->id ?>"><?= $product->count?$product->count:0 ?></span> шт.
                                </span>
                            </h5>
                            <h5 class="mb-1">
                                <span class="text-muted">
                                    Статус: <span style="color:#ffffff;" data-type="select" data-parameter="status" data-source="<?= htmlentities($product->getJsonStatus()) ?>" data-fast-edit-field="<?= $product->id ?>"><?= $product->getStatusActive() ?></span>
                                </span>
                            </h5>
                            <h5 class="mb-1 sp-line-1"><span class="text-muted">Каталог: <?= $product->getCatalogName() ?></span></h5>
                            <h5 class="mb-1 sp-line-1"><span class="text-success"><?= $product->article ?></span></h5>
                        </div>
                        <div class="col-auto">
                            <div class="product-price-tag">
                                &#8381; <span style="color:#ffffff;" data-type="text" data-parameter="price" data-source="" data-fast-edit-field="<?= $product->id ?>"><?= $product->price ?></span>
                            </div>
                            <div class="mt-3">
                                <button type="button" data-fast-edit-product="<?= $product->id ?>" class="btn btn-xs btn-outline-info waves-effect waves-light"><i class="mdi mdi-pencil"></i></button>
                                <button type="button" data-fast-edit-product-cancel class="btn btn-xs btn-outline-danger waves-effect waves-light d-none ml-2"><i class="mdi mdi-cancel"></i></button>
                                <button type="button" data-fast-edit-product-complete="<?= $product->id ?>" class="btn btn-xs btn-outline-success waves-effect waves-light d-none ml-2"><i class="mdi mdi-check"></i></button>
                            </div>
                        </div>
                    </div> <!-- end row start 0 1 2 3 end start 4 5 6 7 end -->
                </div> <!-- end product info-->
            </div> <!-- end card-box-->
        </div>
        <?= ($index == count($data) - 1)?'</div>':''?>
    <?php endforeach; else:?>
        <div class="row">
            <div class="text-body text-center text-danger">
                <h4>Не найдено ни одного продукта</h4>
            </div>
        </div>
    <?php endif;?>
    <div class="row">
        <div class="col-12">
            <?= LinkPager::widget([
                'pagination' => $pages ,
                'activePageCssClass' => 'active',
                'pageCssClass' => 'page-item',
                'firstPageCssClass' => 'page-item',
                'lastPageCssClass' => 'page-item',
                'disableCurrentPageButton' => false,
                'prevPageLabel' => '«',
                'nextPageLabel' => '»',
                'maxButtonCount' => 7 ,
                'linkOptions' => ['class' => 'page-link'],
                'options' => ['class' => 'pagination pagination-rounded justify-content-end mb-3']
            ] ); ?>
        </div> <!-- end col-->
    </div>
    <!-- end row-->

</div>
