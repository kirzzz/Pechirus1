<?php
/* @var $this yii\web\View */
/* @var $steal Steal */
/* @var $pages Pagination */
/* @var $model CopyProduct */


use app\assets\Select2Asset;
use app\models\Brand;
use app\models\Catalog;
use app\models\CopyProduct;
use app\models\Steal;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;

Select2Asset::register($this);

$this->title = 'Заимтвование продуктов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Заимтвование продуктов</li>
                    </ol>
                </div>
                <h4 class="page-title">Заимтвование продуктов</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <?php if(!empty($steal)):?>
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-5">
                        <?php $images = json_decode($steal->pictures,true); ?>
                        <?php if(!empty($images)):?>
                        <div class="tab-content pt-0">
                            <?php foreach ($images as $index=>$image):?>
                            <div class="tab-pane  <?= $index==0?'active':'' ?>" id="product-<?= $index ?>-item">
                                <img src="<?= $image ?>" alt="<?= basename($image) ?>" class="img-fluid mx-auto d-block rounded">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <ul class="nav nav-pills nav-justified">
                            <?php foreach ($images as $index=>$image):?>
                                <li class="nav-item">
                                    <a href="#product-<?= $index ?>-item" data-toggle="tab" aria-expanded="false" class="nav-link product-thumb <?= $index==0?'active':'' ?>">
                                        <img style="max-height: 75px" src="<?= $image ?>" alt="<?= basename($image) ?>" class="img-fluid mx-auto d-block rounded">
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div> <!-- end col -->
                    <div class="col-lg-7">
                        <div class="pl-xl-3 mt-3 mt-xl-0">
                            <a href="<?= $steal->url ?>" class="text-primary"><?= $steal->siteName ?></a>
                            <h4 class="mb-3"><?= $steal->name ?></h4>
                            <h4 class="mb-4">Цена: <span class="text-muted mr-2"><b><?= $steal->price ?></b></h4>
                            <p class="text-muted mb-4"><?= strip_tags($steal->description) ?></p>
                            <?php $form = ActiveForm::begin([
                                'id' => 'product-copy',
                                'options' => ['class'=>'col mb-4'],
                                'errorCssClass' => 'text-danger'
                            ]) ?>
                            <?= $form->field($model, 'steal_id')->hiddenInput()->label(false) ?>
                            <?= $form->field($model, 'price') ?>
                            <?= $form->field($model, 'in_stock', ['template' => '{input}{label}{error}'
                                ,'options' => ['class' => 'form-group custom-control custom-switch'],'labelOptions' => [ 'class' => 'custom-control-label' ]])
                                ->checkbox(['class'=>'custom-control-input'],false) ?>
                            <?= $form->field($model, 'hidden', ['template' => '{input}{label}{error}'
                                ,'options' => ['class' => 'form-group custom-control custom-switch'],'labelOptions' => [ 'class' => 'custom-control-label' ]])
                                ->checkbox(['class'=>'custom-control-input'],false) ?>
                            <?= $form->field($model, 'id_brand')->dropDownList(ArrayHelper::map(Brand::find()->all(),'id','name'),[
                                'prompt' => 'Выберите Брэнд',
                                'data-toggle'=>"select2"
                            ]); ?>
                            <?= $form->field($model, 'id_catalog')->dropDownList(ArrayHelper::map(Catalog::find()->all(),'id','name'),[
                                'prompt' => 'Выберите Каталог',
                                'data-toggle'=>"select2"
                            ]); ?>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success waves-effect waves-light" form="product-copy" name="copy">
                                    <span class="btn-label"><i class="mdi mdi-plus"></i></span>Добавить
                                </button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light" form="product-copy" name="remove">
                                    <span class="btn-label"><i class="mdi mdi-trash-can"></i></span>Удалить из копирования
                                </button>
                            </div>
                            <?php $form::end() ?>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <?php $steal_property = json_decode($steal->parameters,true); ?>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-centered mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>Наименование</th>
                            <th>Значение</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($steal_property as $index=>$row):?>
                            <?php if(isset($row['name'])): ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['value'] ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <?php else: ?>
                <h4 class="header-title text-center text-info">Не найдено продуктов для заимствования</h4>
            <?php endif; ?>
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-12">
            <?= LinkPager::widget([
                'pagination' => $pages,
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

</div>
