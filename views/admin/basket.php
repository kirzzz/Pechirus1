<?php
/* @var $this yii\web\View */
/* @var $data Basket[] */


use app\assets\DataTables;
use app\models\Basket;
use yii\helpers\Url;

DataTables::register($this);
\app\assets\Select2Asset::register($this);

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Корзина</li>
                    </ol>
                </div>
                <h4 class="page-title">Корзина</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Все Корзины</h4>
                    <p class="text-muted font-13 mb-4">
                        В данной таблице представлены все Активные Корзины пользователей.
                    </p>
                    <?php if(!empty((array)$data)): ?>
                        <table id="datatable-buttons" class="table table-striped dt-responsive">
                            <thead>
                            <tr>
                                <th colspan="1">ID</th>
                                <th colspan="1">Пользователь</th>
                                <th colspan="1">Продукт</th>
                                <th colspan="1">Количество</th>
                                <th colspan="1">Дата создания</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $datum): ?>
                                <?php $user = \app\models\User::find()->where(['id'=>$datum->idUser])->one();?>
                                <?php $product = \app\models\Product::find()->andWhere(['id'=>$datum->idProduct])->one();?>
                                <?php $image = (isset($product->img) and isset(json_decode($product->img,true)[0]['path']))?json_decode($product->img,true)[0]['path']:'images/default/no-image.png' ?>
                                <tr>
                                    <td><?= $datum->id ?></td>
                                    <td>
                                        <a href="<?= Url::toRoute(['admin/users','id'=>$datum->idUser]) ?>">
                                            <?= (isset($user->name) or isset($user->surname))?((isset($user->name)?$user->name:'') . ' ' . (isset($user->surname)?$user->surname:'')):$user->username ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= Url::toRoute(['site/product','id'=>$datum->idProduct]) ?>">
                                            <img src="/<?= $image ?>" alt="product-img" height="32">
                                        </a>
                                    </td>
                                    <td><?= $datum->count ?></td>
                                    <td><?= date('d.m.Y H:i:s',$datum->created_at) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h4 class="header-title text-center text-info">Нет активных корзин</h4>
                    <?php endif; ?>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div>
