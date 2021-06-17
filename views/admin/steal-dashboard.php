<?php
/* @var $this yii\web\View */
/* @var $data array */


use yii\helpers\Url;

\app\assets\StealAssets::register($this);
\app\assets\CounterAsset::register($this);

$this->title = 'Заимствование';
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
                        <li class="breadcrumb-item active">Заимствование - Главная</li>
                    </ol>
                </div>
                <h4 class="page-title">Заимствование - Главная</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Количество продуктов, которым было назначено соответствие с импортированными товарами на странице 'Назначение соответствий'"></i>
                <h4 class="mt-0 font-16">Соответствия</h4>
                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup"><?= $data['top']['count-compare'] ?></span></h2>
                <p class="text-muted mb-0">Всего: <?= $data['top']['count-steal'] ?><span class="float-right"><i class="fa fa-caret-up text-success mr-1"></i><?= round(($data['top']['count-compare']/$data['top']['count-steal'])*100, 2) ?>%</span></p>
            </div>
        </div>

        <?php //array(2) { ["top"]=> array(6) { ["count-steal"]=> string(4) "4007" ["count-compare"]=> string(3) "235" ["count-site"]=> string(1) "1" ["count-site-target"]=> int(10) ["steal-price-avg"]=> string(10) "19733.8085" ["my-price-avg"]=> string(10) "18461.4468" } ["chart"]=> array(0) { } }?>

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Количество сайтов 'импортеров'"></i>
                <h4 class="mt-0 font-16">Магазины</h4>
                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup"><?= $data['top']['count-site'] ?></span></h2>
                <p class="text-muted mb-0">Цель: <?= $data['top']['count-site-target'] ?> <span class="float-right"><i class="fa fa-caret-down text-danger mr-1"></i><?= round(($data['top']['count-site']/$data['top']['count-site-target'])*100, 2) ?>%</span></p>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Средняя цена импортированных продуктов с соответствием"></i>
                <h4 class="mt-0 font-16">Средняя цена</h4>
                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup"><?= round($data['top']['steal-price-avg'],2) ?></span>₽</h2>
                <p class="text-muted mb-0">Наша цена: <?= round($data['top']['my-price-avg'],2) ?>₽<span class="float-right"><i class="fa fa-caret-up text-success mr-1"></i><?= round(($data['top']['steal-price-avg']/$data['top']['my-price-avg'])*100, 2) ?>%</span></p>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
                <h4 class="mt-0 font-16">Total Revenue</h4>
                <h2 class="text-primary my-3 text-center">$<span data-plugin="counterup">68,541</span></h2>
                <p class="text-muted mb-0">Total revenue: $1.2 M <span class="float-right"><i class="fa fa-caret-up text-success mr-1"></i>17.48%</span></p>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="float-right d-none d-md-inline-block">
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-secondary">Today</button>
                            <button type="button" class="btn btn-xs btn-light">Weekly</button>
                            <button type="button" class="btn btn-xs btn-light">Monthly</button>
                        </div>
                    </div>
                    <h4 class="header-title">Revenue</h4>
                    <div class="row mt-4 text-center">
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$7.8k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                            <h4><i class="fe-arrow-up text-success mr-1"></i>$1.4k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$15k</h4>
                        </div>
                    </div>
                    <div class="mt-3 chartjs-chart">
                        <canvas id="revenue-chart" data-colors="#1fa083,#f1556c" height="300"></canvas>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="float-right d-none d-md-inline-block">
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-secondary">Today</button>
                            <button type="button" class="btn btn-xs btn-light">Weekly</button>
                            <button type="button" class="btn btn-xs btn-light">Monthly</button>
                        </div>
                    </div>
                    <h4 class="header-title">Projections Vs Actuals</h4>
                    <div class="row mt-4 text-center">
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$3.8k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                            <h4><i class="fe-arrow-up text-success mr-1"></i>$1.1k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$25k</h4>
                        </div>
                    </div>
                    <div class="mt-3 chartjs-chart">
                        <canvas id="projections-actuals-chart" data-colors="#4a81d4,#e3eaef" height="300"></canvas>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
