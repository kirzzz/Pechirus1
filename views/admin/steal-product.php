<?php
/* @var $this yii\web\View */
/* @var $steal Steal */
/* @var $pages \yii\data\Pagination */


use app\assets\Select2Asset;
use app\models\Steal;
use yii\helpers\Url;
use yii\widgets\LinkPager;

Select2Asset::register($this);

$this->title = 'Корзина';
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
                        <li class="breadcrumb-item active">Добавление продуктов</li>
                    </ol>
                </div>
                <h4 class="page-title">Добавление продуктов</h4>
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
                                <img style="max-height: 350px" src="<?= $image ?>" alt="<?= basename($image) ?>" class="img-fluid mx-auto d-block rounded">
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
                            <form class="form-row mb-4">
                                <label class="my-1 mr-2" for="quantityinput">Quantity</label>
                                <select class="custom-select my-1 mr-sm-3" id="quantityinput">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>

                                <label class="my-1 mr-2" for="sizeinput">Size</label>
                                <select class="custom-select my-1 mr-sm-3" id="sizeinput">
                                    <option selected>Small</option>
                                    <option value="1">Medium</option>
                                    <option value="2">Large</option>
                                    <option value="3">X-large</option>
                                </select>

                                <input type="text" class="custom-">
                            </form>

                            <div>
                                <button type="button" class="btn btn-danger mr-2"><i class="mdi mdi-heart-outline"></i></button>
                                <button type="button" class="btn btn-success waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-cart"></i></span>Add to cart
                                </button>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <?php $steal_property = json_decode($steal->parameters,true); ?>
                <?php var_dump($steal_property) ?>
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
