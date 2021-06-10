<?php
/* @var $this yii\web\View */
/* @var $general_stat array*/
/* @var $table_product Product[]*/
/* @var $json array*/

use app\models\Product;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

\app\assets\AdminDashboard::register($this);

$this->title = 'Главная';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <?php ActiveForm::begin(['method' => 'get','action' => Url::toRoute(['admin/index']),'options' => ['class'=>'form-inline']])?>
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <?php $get = Yii::$app->request->get();?>
                                <input type="text" class="form-control border" name="date" id="dash-daterange" value="<?= isset($get['date'])?$get['date']:'' ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-blue border-blue text-white">
                                        <i class="mdi mdi-calendar-range"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-blue btn-sm ml-2">
                            <i class="mdi mdi-autorenew"></i>
                        </button>
                    <?php ActiveForm::end() ?>
                </div>
                <h4 class="page-title">Главная</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                            <i class="fe-heart font-22 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1">&#8381;<span data-plugin="counterup"><?= number_format($general_stat['orders']['sum']) ?></span></h3>
                            <p class="text-muted mb-1 text-truncate">Сумма заказов</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= number_format($general_stat['orders']['count']) ?></span></h3>
                            <p class="text-muted mb-1 text-truncate">Количество заказов</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= number_format($general_stat['users']['count']) ?></span></h3>
                            <p class="text-muted mb-1 text-truncate">Новых пользователей</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                            <i class="fe-eye font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= number_format($general_stat['products']['count']) ?></span></h3>
                            <p class="text-muted mb-1 text-truncate">Количество продуктов</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="header-title mb-0">Прибыль</h4>

                <div class="widget-chart text-center" dir="ltr">

                    <div id="total-revenue" class="mt-0"  data-colors="#f1556c"></div>

                    <h5 class="text-muted mt-0">За сегодня</h5>
                    <h2>$178</h2>

                    <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading elements are designed to work best in the meat of your page content.</p>

                    <div class="row mt-3">
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Сегодня</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$7.8k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Последняя неделя</p>
                            <h4><i class="fe-arrow-up text-success mr-1"></i>$1.4k</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">Последний месяц</p>
                            <h4><i class="fe-arrow-down text-danger mr-1"></i>$15k</h4>
                        </div>
                    </div>

                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->

        <div class="col-lg-8">
            <div class="card-box pb-2">
                <div class="float-right d-none d-md-inline-block">
                    <div class="btn-group mb-2">
                        <button type="button" class="btn btn-xs btn-light">Today</button>
                        <button type="button" class="btn btn-xs btn-light">Weekly</button>
                        <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                    </div>
                </div>

                <h4 class="header-title mb-3">Sales Analytics</h4>

                <div dir="ltr">
                    <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card-box">
                <h4 class="header-title mb-3">Топ популярных продуктов</h4>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Продукт</th>
                            <th>Стоимость</th>
                            <th>Артикул</th>
                            <th>Количество заказов</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($table_product as $product): ?>
                        <tr>
                            <td><?= $product->id ?></td>
                            <td style="width: 36px;">
                                <img src="/<?= $product->img !== '[]'?json_decode($product->img,true)[0]['path']:'images/default/no-image.png'?>" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                            </td>
                            <td>
                                <?= $product->new_price?"<span class='text-muted mr-2'><del>&#8381;".$product->price."</del></span> <b>&#8381;".$product->new_price."</b>":"<b>&#8381;".$product->price."</b>" ?>
                            </td>

                            <td>
                                <?= $product->article ?>
                            </td>

                            <td>
                               <?= $json[$product->id] ?>
                            </td>

                            <td>
                                <a href="<?= Url::toRoute(['admin/product','id'=>$product->id])?>" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                <a href="<?= Url::toRoute(['site/product','id'=>$product->id])?>" class="btn btn-xs btn-info"><i class="mdi mdi-eye-check-outline"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card-box">

                <h4 class="header-title mb-3">Revenue History</h4>

                <div class="table-responsive">
                    <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>Marketplaces</th>
                            <th>Date</th>
                            <th>Payouts</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Themes Market</h5>
                            </td>

                            <td>
                                Oct 15, 2018
                            </td>

                            <td>
                                $5848.68
                            </td>

                            <td>
                                <span class="badge bg-soft-warning text-warning">Upcoming</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Freelance</h5>
                            </td>

                            <td>
                                Oct 12, 2018
                            </td>

                            <td>
                                $1247.25
                            </td>

                            <td>
                                <span class="badge bg-soft-success text-success">Paid</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Share Holding</h5>
                            </td>

                            <td>
                                Oct 10, 2018
                            </td>

                            <td>
                                $815.89
                            </td>

                            <td>
                                <span class="badge bg-soft-success text-success">Paid</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Envato's Affiliates</h5>
                            </td>

                            <td>
                                Oct 03, 2018
                            </td>

                            <td>
                                $248.75
                            </td>

                            <td>
                                <span class="badge bg-soft-danger text-danger">Overdue</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Marketing Revenue</h5>
                            </td>

                            <td>
                                Sep 21, 2018
                            </td>

                            <td>
                                $978.21
                            </td>

                            <td>
                                <span class="badge bg-soft-warning text-warning">Upcoming</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Advertise Revenue</h5>
                            </td>

                            <td>
                                Sep 15, 2018
                            </td>

                            <td>
                                $358.10
                            </td>

                            <td>
                                <span class="badge bg-soft-success text-success">Paid</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!-- end .table-responsive-->
            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container -->


