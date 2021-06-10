<?php
/* @var $this yii\web\View */
/* @var $contacts Contact[] */


use app\assets\DataTables;
use app\models\Contact;
use yii\helpers\Url;

DataTables::register($this);
\app\assets\Select2Asset::register($this);

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Заявки</li>
                    </ol>
                </div>
                <h4 class="page-title">Заявки</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Все Заявки</h4>
                    <p class="text-muted font-13 mb-4">
                        В данной таблице представлены все Заявки оставленные пользавателями в разделе "Связаться со мной".
                    </p>
                    <?php if(!empty((array)$contacts)): ?>
                        <table id="datatable-buttons" class="table table-striped dt-responsive">
                            <thead>
                            <tr>
                                <th colspan="1">ID</th>
                                <th colspan="1">Имя</th>
                                <th colspan="1">Телефон</th>
                                <th colspan="1">Email</th>
                                <th colspan="1">Сообщение</th>
                                <th colspan="1">Дата создания</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($contacts as $contact): ?>
                                <tr>
                                    <td><?= $contact->id ?></td>
                                    <td><?= $contact->name ?></td>
                                    <td><?= $contact->tel ?></td>
                                    <td><?= $contact->email ?></td>
                                    <td><?= $contact->message ?></td>
                                    <td><?= date('d.m.Y H:i:s',$contact->created_at) ?></td>
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
