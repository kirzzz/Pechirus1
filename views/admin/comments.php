<?php
/* @var $this yii\web\View */
/* @var $comments Comments[] */


use app\assets\DataTables;
use app\models\Comments;
use yii\helpers\Url;

DataTables::register($this);
\app\assets\Select2Asset::register($this);

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Комментарии</li>
                    </ol>
                </div>
                <h4 class="page-title">Комментарии</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Все Комментарии</h4>
                    <p class="text-muted font-13 mb-4">
                        В данной таблице представлены все Комментарии оставленные пользавателями на сайте.
                    </p>
                    <?php if(!empty((array)$comments)): ?>
                        <table id="datatable-buttons" class="table table-striped dt-responsive">
                            <thead>
                            <tr>
                                <th colspan="1">ID</th>
                                <th colspan="1">Пользователь</th>
                                <th colspan="1">Продукт</th>
                                <th colspan="1">Оценка</th>
                                <th colspan="1">Текст</th>
                                <th colspan="1">Дата создания</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($comments as $comment): ?>
                                <?php $user = \app\models\User::find()->where(['id'=>$comment->idUser])->one();?>
                                <?php $product = \app\models\Product::find()->where(['id'=>$comment->idProduct])->one();?>
                                <?php $image = $product->img !== '[]'?json_decode($product->img,true)[0]['path']:'images/default/no-image.png' ?>
                                <tr>
                                    <td><?= $comment->id ?></td>
                                    <td><?php if(isset($user->id)):?>
                                        <a href="<?= Url::toRoute(['admin/users','id'=>$comment->idUser]) ?>">
                                            <?= (isset($user->name) or isset($user->surname))?((isset($user->name)?$user->name:'') . ' ' . (isset($user->surname)?$user->surname:'')):$user->username ?>
                                        </a>
                                        <?php else:?>
                                        <?= $comment->name ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= Url::toRoute(['site/product','id'=>$comment->idProduct]) ?>">
                                            <img src="/<?= $image ?>" alt="product-img" height="32">
                                        </a>
                                    </td>
                                    <td><?= $comment->rating ?></td>
                                    <td><?= $comment->text ?></td>
                                    <td><?= date('d.m.Y H:i:s',$comment->created_at) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h4 class="header-title text-center text-info">Нет комментариев</h4>
                    <?php endif; ?>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div>
