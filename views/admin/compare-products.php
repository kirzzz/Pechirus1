<?php
/* @var $this yii\web\View */
/* @var $compare ProductToSteal[] */


use app\models\Product;
use app\models\ProductToSteal;
use yii\helpers\Url;
use yii\widgets\LinkPager;

\app\assets\CounterAsset::register($this);

$this->title = 'Сравнение продуктов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Сравнение продуктов</li>
                    </ol>
                </div>
                <h4 class="page-title">Сравнение продуктов</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <?php foreach ($compare as $index => $comp):?>
                        <?php
                        $product = Product::find()->where(['id'=>$comp->id_product])->one();
                        $steals = ProductToSteal::find()
                            ->where(['id_product'=>$comp->id_product])
                            ->andWhere(['status'=>ProductToSteal::STATUS_NO_SOLUTION])
                            ->joinWith('steal')
                            ->orderBy('rateName desc')
                            ->all();
                        ?>
                        <tr>
                            <td>Наименование</td>
                            <td>
                                <h5 class="m-0 fw-normal"><?= $product->name ?></h5>
                                <p class="mb-0 text-muted"><strong>Цена: <?= $product->price ?></strong></p>
                            </td>
                            <?php foreach ($steals as $steal):?>
                            <td>
                                <h5 class="m-0 fw-normal"><?= $steal['steal']['name'] ?></h5>
                                <p class="mb-0 text-muted"><strong>Цена: <?= $steal['steal']['price'] ?></strong></p>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Процент соответствия</td>
                            <td></td>
                            <?php foreach ($steals as $steal):?>
                            <td>
                                <dl class="row">
                                    <dt class="col-sm-9">Наименование</dt>
                                    <dd class="col-sm-3"><?= $steal->rateName ?>%</dd>
                                    <dt class="col-sm-9">Хар-ки</dt>
                                    <dd class="col-sm-3"><?= $steal->rateProperty ?>%</dd>
                                    <dt class="col-sm-9">Описание</dt>
                                    <dd class="col-sm-3"><?= $steal->rateDescription ?>%</dd>
                                </dl>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Маганиз</td>
                            <td><p class="mb-0 fw-normal text-info">ПечиРУС</td>
                            <?php foreach ($steals as $steal):?>
                                <td><p class="mb-0 fw-normal text-info"><?= $steal['steal']['siteName'] ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Описание</td>
                            <td><?= strip_tags($product->description) ?></td>
                            <?php foreach ($steals as $steal):?>
                                <td><?= strip_tags($steal['steal']['description']) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Характеристики</td>
                            <td>
                                <?php $options_p = json_decode($product->property,true) ?>
                                <?php if(isset($options_p['myrows'])):?>
                                <ol>
                                <?php foreach ($options_p['myrows'] as $option):?>
                                            <li>
                                                <strong><?= $option['name'] ?></strong>
                                                <span><?= $option['value'] ?></span>
                                            </li>
                                <?php endforeach;?>
                                </ol>
                                <?php else: ?>
                                    <p class="text-danger">У данного товара отсутствуют характеристики.</p>
                                <?php endif; ?>
                            </td>
                            <?php foreach ($steals as $steal):?>
                                <td>
                                    <?php $options = json_decode($steal['steal']['parameters'],true) ?>
                                    <?php if($options):?>
                                    <ol>
                                        <?php foreach ($options as $option):?>
                                            <li>
                                                <strong><?= $option['name'] ?></strong>
                                                <span><?= $option['value'] ?></span>
                                            </li>
                                        <?php endforeach;?>
                                    </ol>
                                    <?php else: ?>
                                        <p class="text-danger">У данного товара отсутствуют характеристики.</p>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Обновить</td>
                            <td></td>
                            <?php foreach ($steals as $steal):?>
                                <td>
                                    <div class="btn-group-vertical mb-2 w-100">
                                        <button data-admin-functions="steal-compare" data-steal-compare-id="<?= $steal->id ?>" data-steal-type="options" class="btn btn-sm waves-effect waves-light btn-info nav-link d-flex justify-content-between">
                                            <span class="btn-label" style="width: 45px"><i class="fas fa-cog"></i></span>Хар-ки
                                        </button>
                                        <button data-admin-functions="steal-compare" data-steal-compare-id="<?= $steal->id ?>" data-steal-type="description" class="btn btn-sm waves-effect waves-light btn-info nav-link d-flex justify-content-between">
                                            <span class="btn-label" style="width: 45px"><i class="fas fa-receipt"></i></span>Описание
                                        </button>
                                        <button data-admin-functions="steal-compare" data-steal-compare-id="<?= $steal->id ?>" data-steal-type="all" class="btn btn-sm waves-effect waves-light btn-success nav-link d-flex justify-content-between">
                                            <span class="btn-label" style="width: 45px"><i class="fas fa-check-double"></i></span>Всё
                                        </button>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Соответствие</td>
                            <td>
                                <button data-admin-functions="steal-compare" data-steal-compare-id="<?= $steal->id ?>" data-steal-type="remove-all" class="btn btn-sm waves-effect waves-light btn-danger nav-link d-flex justify-content-between">
                                    <span class="btn-label" style="width: 45px"><i class="fas fa-trash"></i></span>Нет соответствий
                                </button>
                            </td>
                            <?php foreach ($steals as $steal):?>
                                <td>
                                    <div class="btn-group-vertical mb-2 w-100">
                                        <button data-admin-functions="steal-compare" data-steal-compare-id="<?= $steal->id ?>" data-steal-type="remove" class="btn btn-sm waves-effect waves-light btn-danger nav-link d-flex justify-content-between">
                                            <span class="btn-label" style="width: 45px"><i class="fad fa-times-octagon"></i></span>Не соответствует
                                        </button>
                                        <button data-admin-functions="steal-compare" data-steal-compare-id="<?= $steal->id ?>" data-steal-type="accept" class="btn btn-sm waves-effect waves-light btn-success nav-link d-flex justify-content-between">
                                            <span class="btn-label" style="width: 45px"><i class="fad fa-shield-check"></i></span>Соответствует
                                        </button>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
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
