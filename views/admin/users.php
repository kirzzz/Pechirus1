<?php
/* @var $this yii\web\View */
/* @var $data User[] */
/* @var $user_get User */
/* @var $user_info array */


use app\assets\DataTables;
use app\models\User;
use yii\helpers\Url;

DataTables::register($this);
\app\assets\Select2Asset::register($this);

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Пользователи</li>
                    </ol>
                </div>
                <h4 class="page-title">Пользователи</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if(!empty((array)$data)): ?>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Все Пользователи</h4>
                    <p class="text-muted font-13 mb-4">
                        В данной таблице представлены все Пользователи рошедшие решистрацию на сайта (Пользовател производивший заказ также является зарегестрированным).
                    </p>
                    <table id="datatable-buttons" class="table table-striped dt-responsive">
                        <thead>
                        <tr>
                            <th colspan="1">ID</th>
                            <th colspan="1">Логин</th>
                            <th colspan="1">Имя</th>
                            <th colspan="1">Телефон</th>
                            <th colspan="1">Email</th>
                            <th colspan="1">Дата создания</th>
                            <th colspan="1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $user): ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= isset($user->name)?($user->name . ' ' . $user->surname):'Не указан' ?></td>
                                <td><?= $user->tel ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= date('d.m.Y H:i:s',$user->created_at) ?></td>
                                <td><a href="<?= Url::toRoute(['admin/users','id'=>$user->id]) ?>" class="action-icon"><i class="fal fa-eye"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
        <div class="col-lg-4">
            <div class="card-box">
                <div class="media mb-3">
                    <div class="media-body">
                        <h4 class="mt-0 mb-1"><?= $user_get->username ?></h4>
                        <?php if(isset($user_get->name) or isset($user_get->surname)): ?><p class="text-muted"><?= $user_get->name .' '. $user_get->surname ?></p><?php endif; ?>
                        <p class="text-muted"><i class="fal fa-at mr-2"></i><?= $user_get->email ?></p>
                        <p class="text-muted"><i class="fal fa-phone-alt mr-2"></i><?= $user_get->tel ?></p>

                        <!--<a href="javascript: void(0);" class="btn- btn-xs btn-info">Send Email</a>
                        <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Call</a>
                        <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Edit</a>-->
                    </div>
                </div>

                <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Персональная информация</h5>
                <div class="">
                    <h4 class="font-13 text-muted text-uppercase">Адрес:</h4>
                    <p class="mb-3">
                        <?= isset($user_get->address)?$user_get->address:'Не указан' ?>
                    </p>

                    <h4 class="font-13 text-muted text-uppercase mb-2">Количество заказов : <?= $user_info['count_orders'] ?></h4>

                    <h4 class="font-13 text-muted text-uppercase mb-2">Количество продуктов в корзине : <?= $user_info['count_baskets'] ?></h4>

                    <h4 class="font-13 text-muted text-uppercase mb-2">Количество комментариев : <?= $user_info['count_comments'] ?></h4>

                    <h4 class="font-13 text-muted text-uppercase mb-1">Дата регистрации :</h4>
                    <p class="mb-3"><?= date('d.m.Y H:i:s',$user_get->created_at) ?></p>

                    <h4 class="font-13 text-muted text-uppercase mb-1">Дата последнего обновления:</h4>
                    <p class="mb-3"><?= date('d.m.Y H:i:s',$user_get->updated_at) ?></p>

                    <h4 class="font-13 text-muted text-uppercase mb-1">IP создания :</h4>
                    <p class="mb-3"><?= $user_get->ip_create ?></p>

                </div>

            </div> <!-- end card-box-->
        </div>
        <?php else: ?>
            <h4 class="header-title text-center text-info">Нет пользователей</h4>
        <?php endif; ?>
    </div>
</div>
