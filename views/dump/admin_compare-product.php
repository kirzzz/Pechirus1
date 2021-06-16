<?php
/* @var $this yii\web\View */
/* @var $compare ProductToSteal[] */


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
    <?php foreach ($compare as $index => $comp):?>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="widget-rounded-circle card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-primary">
                                            <i class="fas fa-font font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $comp->rateName ?>%</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Наименование</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->

                    <div class="col-md-3">
                        <div class="widget-rounded-circle card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-warning">
                                            <i class="fas fa-equals font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $comp->rateNameNumbers ?>%</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Цифры</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->

                    <div class="col-md-3">
                        <div class="widget-rounded-circle card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-success">
                                            <i class="fas fa-receipt font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $comp->rateDescription ?>%</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Описание</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->

                    <div class="col-md-3">
                        <div class="widget-rounded-circle card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-danger">
                                            <i class="fas fa-cog font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $comp->rateProperty ?>%</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Характеристики</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title mb-4 text-justify">
                                    <span><?= $comp['product']['name'] ?></span>
                                    <span><?= $comp['product']['price'] ?></span>
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <h4 class="header-title mb-4 text-justify">
                                    <span><?= $comp['steal']['name'] ?></span>
                                    <span><?= $comp['steal']['price'] ?></span>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <ul class="nav nav-tabs nav-bordered nav-justified" id="callapse_parent_<?= $index?>">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" data-toggle="collapse" data-target=".options_<?= $index?>" aria-expanded="false" aria-controls="options_<?= $index ?> options_<?= $index ?>_first">
                                        Описание
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" data-toggle="collapse" data-target=".description_<?= $index ?>" aria-expanded="false" aria-controls="description_<?= $index ?> description_<?= $index ?>_first">
                                        Характеристики
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tab-content pt-0">
                                    <div class="tab-pane fade description_<?= $index?> collapse show" id="description_<?= $index?>_first" data-parent="#callapse_parent_<?= $index?>">
                                        <p><?= $comp['product']['description'] ?></p>
                                    </div>
                                    <div class="tab-pane fade options_<?= $index?> collapse" id="options_<?= $index?>" data-parent="#callapse_parent_<?= $index?>">
                                        <p>
                                            <?php $options = json_decode($comp['product']['property'],true) ?>
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
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tab-content pt-0">
                                    <div class="tab-pane fade description_<?= $index?>" id="description_<?= $index?>">
                                        <p><?= $comp['steal']['description'] ?></p>
                                    </div>
                                    <div class="tab-pane fade options_<?= $index?>" id="options_<?= $index?>">
                                        <p>
                                            <?php $options = json_decode($comp['steal']['parameters'],true) ?>
                                            <?php if($options):?>
                                        <table>
                                            <tbody>
                                            <?php foreach ($options as $option):?>
                                                <tr>
                                                    <td class="width1"><?= $option['name'] ?></td>
                                                    <td><?= $option['value'] ?></td>
                                                </tr>
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>
                                        <?php else: ?>
                                            У данного товара отсутствуют характеристики.
                                        <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-group btn-group-lg w-100" role="group">
                                    <button type="button" class="btn btn-lg waves-effect waves-light btn-outline-info">Обновить описание</button>
                                    <button type="button" class="btn btn-lg waves-effect waves-light btn-outline-success">Обновить все</button>
                                    <button type="button" class="btn btn-lg waves-effect waves-light btn-outline-blue">Обновить хар-ки</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    <?php endforeach; ?>
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
