<?php
/* @var $this yii\web\View */
/* @var $orders Orders[] */


use app\assets\DataTables;
use app\models\Orders;
use yii\helpers\Url;

DataTables::register($this);
\app\assets\Select2Asset::register($this);

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Заказы</li>
                    </ol>
                </div>
                <h4 class="page-title">Заказы</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-1">
                <div class="card-header" id="collapseProductDescParent">
                    <h5 class="m-0 d-flex">
                        <a class="custom-accordion-title text-reset d-block" data-toggle="collapse" href="#collapseProductDesc" aria-expanded="true" aria-controls="collapseProductDesc">
                            <i class="fas fa-filter mr-2"></i>
                            Отфильтровать записи
                        </a>
                        <a class="ml-auto custom-accordion-title text-reset d-block" href="<?= Url::toRoute(['admin/orders']) ?>">
                            <i class="fal fa-filter mr-2"></i>
                            Сбросить фильтр
                        </a>
                    </h5>
                </div>
                <div id="collapseProductDesc" class="collapse" aria-labelledby="headingFour" data-parent="#collapseProductDescParent" style="">
                    <div class="card-body">
                        <?php \yii\widgets\ActiveForm::begin(['method' => 'get','action' => Url::toRoute(['admin/orders'])]) ?>
                        <div class="form-group">
                            <label for="status_filter">Статус</label>
                            <select id="status_filter" name="status[]" data-toggle="select2" multiple data-maximum-selection-length="<?= count(Orders::STATUS_DESCRIPTION )?>">
                                <?php foreach (Orders::STATUS_DESCRIPTION as $index_sf=>$statusf):?>
                                    <option value="<?= $index_sf ?>"><?= $statusf ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type_of_delivery_filter">Тип доставки</label>
                            <select name="type_of_delivery[]" id="type_of_delivery_filter" data-toggle="select2" multiple data-maximum-selection-length="<?= count(Orders::TYPE_OF_DELIVERY )?>">
                                <?php foreach (Orders::TYPE_OF_DELIVERY as $typef):?>
                                    <option value="<?= $typef['id'] ?>"><?= $typef['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="region_of_delivery_filter">Регион доставки</label>
                            <select id="region_of_delivery_filter" name="region_of_delivery[]" data-toggle="select2" multiple data-maximum-selection-length="<?= count(Orders::REGION_OF_DELIVERY )?>">
                                <?php foreach (Orders::REGION_OF_DELIVERY as $regionf):?>
                                    <option value="<?= $regionf['id'] ?>"><?= $regionf['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Подтведить</button>
                        <?php \yii\widgets\ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Все заказы</h4>
                    <p class="text-muted font-13 mb-4">
                        В данной таблице представлены все заказы сортированные по дате создания.
                        Для иного сортирования нажмите на наименование столбца.
                        Для получения подробной информации о заказе нажмите на значок "<i class="fal fa-eye mx-2"></i>" в столбце "Детали заказа".
                    </p>
                    <?php if(!empty((array)$orders)): ?>
                    <table id="datatable-buttons" class="table table-striped dt-responsive">
                        <thead>
                        <tr>
                            <th colspan="1">ID Заказа</th>
                            <th colspan="1">Продукты</th>
                            <th colspan="1">Имя Фамилия</th>
                            <th colspan="1">Телефон</th>
                            <th colspan="1">Цена</th>
                            <th colspan="1">Тип доставки</th>
                            <th colspan="1">Статус</th>
                            <th colspan="1">Дата создания</th>
                            <th>Детали заказа</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><a href="<?= Url::toRoute(['admin/orders-details','id'=>$order->id]) ?>"><?= $order->article ?></a></td>
                            <td>
                                <?php foreach(json_decode($order->productInfo,true) as $product): ?>
                                <?php $product_main = \app\models\Product::find()->select('img')->where(['id'=>$product['idProduct']])->one()?>
                                <?php $image = $product_main->img !== '[]'?json_decode($product_main->img,true)[0]['path']:'images/default/no-image.png' ?>
                                <a href="<?= Url::toRoute(['site/product','id'=>$product['idProduct']]) ?>">
                                    <img src="/<?= $image ?>" alt="product-img" height="32">
                                </a>
                                <?php endforeach; ?>
                            </td>
                            <td><a class="text-nowrap" href="<?= Url::toRoute(['admin/users','id'=>$order->idUser])?>"><i class="fal fa-user mr-2"></i><?= $order->name.' '.$order->surname ?></a></td>
                            <td class="text-nowrap"><i class="fal fa-phone-square-alt mr-2"></i><?= $order->tel ?></td>
                            <td class="text-nowrap"><i class="fas fa-ruble-sign mr-2"></i><?= $order->price ?></td>
                            <td><?= Orders::TYPE_OF_DELIVERY[array_search($order->typeOfDelivery,array_column(Orders::TYPE_OF_DELIVERY,'id'))]['name'] ?></td>
                            <td data-order-status><?= Orders::STATUS_HTML[$order->status] ?></td>
                            <td><span style="display:none;"><?= $order->created_at ?></span><?= date('d.m.Y H:i:s',$order->created_at) ?></td>
                            <td><a href="<?= Url::toRoute(['admin/orders-details','id'=>$order->id]) ?>" class="action-icon"><i class="fal fa-eye"></i></a></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <h4 class="header-title text-center text-info">Нет заказов</h4>
                    <?php endif; ?>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div>
