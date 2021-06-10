<?php
/* @var $this yii\web\View */
/* @var $order Orders */


use app\models\Orders;
use yii\helpers\Url;

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
                        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['admin/orders']) ?>">Заказы</a></li>
                        <li class="breadcrumb-item active"><?= $order->article ?></li>
                    </ol>
                </div>
                <h4 class="page-title"><?= $order->article ?></h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Статус</h4>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <h5 class="mt-0">ID Заказа:</h5>
                                <p><?= $order->article ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="track-order-list">
                        <ul class="list-unstyled">
                            <?php foreach (Orders::STATUS_DESCRIPTION as $index_sf=>$statusf):?>
                                <li class="<?= $order->status>$index_sf?'completed':'' ?>">
                                    <?= $order->status==$index_sf?'<span class="active-dot dot"></span>':'' ?>
                                    <h5 class="mt-0 mb-1"><?= $statusf ?></h5>
                                    <!--<p class="text-muted">April 21 2019 <small class="text-muted">07:22 AM</small> </p>-->
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="text-left mt-4">
                            <?php \yii\widgets\ActiveForm::begin(['action' => Url::current(),'method' => 'post'])?>
                            <input type="hidden" name="id" value="<?= $order->id ?>">
                            <div class="form-group">
                                <label for="status_filter">Изменить статус</label>
                                <select id="status_filter" name="status" data-toggle="select2">
                                    <?php foreach (Orders::STATUS_DESCRIPTION as $index_sf=>$statusf):?>
                                        <?php if($order->status!==$index_sf): ?>
                                        <option value="<?= $index_sf ?>"><?= $statusf ?></option>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Изменить</button>
                            <?php \yii\widgets\ActiveForm::end()?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Продукты в заказе</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered table-centered mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>Наименование</th>
                                <th>Продукт</th>
                                <th>Артикул</th>
                                <th>Количество</th>
                                <th>Скидка</th>
                                <th>Цена</th>
                                <th>Конечная цена</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $price = 0;$products = json_decode($order->productInfo,true);?>
                            <?php foreach ( $products as $product):?>
                                <?php $product_m = \app\models\Product::find()->where(['id'=>$product['idProduct']])->one() ?>
                                <?php $price += $product['count']*$product['price'] ?>
                                <?php $image = $product_m->img !== '[]'?json_decode($product_m->img,true)[0]['path']:'images/default/no-image.png'?>
                                <tr>
                                    <th scope="row"><?= $product_m->name?></th>
                                    <td><img src="/<?= $image ?>" alt="product-img" height="32"></td>
                                    <th><?= $product_m->article ?></th>
                                    <td><?= $product['count'] ?></td>
                                    <td><?= $product['discount']?'Да':'Нет' ?></td>
                                    <td><i class="fas fa-ruble-sign mr-2"></i><?= $product['price'] ?></td>
                                    <td><i class="fas fa-ruble-sign mr-2"></i><?= $product['count']*$product['price'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th scope="row" colspan="6" class="text-right">Промежуточный итог:</th>
                                <td><div class="font-weight-bold"><i class="fas fa-ruble-sign mr-2"></i><?= $price ?></div></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="6" class="text-right">Доставка:</th>
                                <td><i class="fas fa-ruble-sign mr-2"></i><?= $order->typeOfDelivery !== 1?(Orders::REGION_OF_DELIVERY[array_search($order->regionOfDelivery,array_column(Orders::REGION_OF_DELIVERY,'id'))]['data-order-region-price']):'0' ?></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="6" class="text-right">Итого :</th>
                                <td><div class="font-weight-bold"><i class="fas fa-ruble-sign mr-2"></i><?= $order->price ?></div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Информация о заказчике</h4>
                    <?php $user = \app\models\User::find()->where(['id'=>$order->idUser])->one()?>
                    <h5 class="font-family-primary font-weight-semibold"><a class="text-nowrap" href="<?= Url::toRoute(['admin/users','id'=>$order->idUser])?>"><i class="fal fa-user mr-2"></i><?= $order->name.' '.$order->surname ?></a></h5>
                    <p class="mb-2"><span class="font-weight-semibold mr-2">Телефон:</span> <?= $order->tel ?></p>
                    <p class="mb-2"><span class="font-weight-semibold mr-2">Email:</span> <?= $user->email ?></p>
                    <p class="mb-0"><span class="font-weight-semibold mr-2">Дата создания аккаунта:</span> <?= date('d.m.Y H:i:s',$user->created_at) ?></p>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Информация о доставке</h4>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <p class="mb-2"><span class="font-weight-semibold mr-2">Тип доставки:</span> <?= Orders::TYPE_OF_DELIVERY[array_search($order->typeOfDelivery,array_column(Orders::TYPE_OF_DELIVERY,'id'))]['name'] ?></p>
                            <?php if($order->typeOfDelivery !== 1): ?>
                            <p class="mb-2"><span class="font-weight-semibold mr-2">Адресс:</span> <?= $order->address ?></p>
                            <p class="mb-2"><span class="font-weight-semibold mr-2">Почтовый индекс:</span> <?= $order->postalCode ?></p>
                            <p class="mb-2"><span class="font-weight-semibold mr-2">Регион доставки:</span> <?= Orders::REGION_OF_DELIVERY[array_search($order->regionOfDelivery,array_column(Orders::REGION_OF_DELIVERY,'id'))]['name'] ?></p>
                            <p class="mb-0"><span class="font-weight-semibold mr-2">Комментарий к заказу:</span> <?= $order->comment ?></p>
                            <?php endif; ?>
                        </li>
                    </ul>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Платеж</h4>

                    <div class="text-center">
                        <!--<i class="mdi mdi-truck-fast h2 text-muted"></i>
                        <h5><b>UPS Delivery</b></h5>-->
                        <p class="mb-0"><span class="font-weight-semibold">Тип платежа :</span> <?= Orders::TYPE_OF_PAYMENT[array_search($order->payment,array_column(Orders::TYPE_OF_PAYMENT,'id'))]['name'] . ' ' . Orders::TYPE_OF_PAYMENT[array_search($order->payment,array_column(Orders::TYPE_OF_PAYMENT,'id'))]['name-2'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
