<?php
/* @var $this yii\web\View */
/* @var $data array */
/* @var $load_time int */


use app\assets\DataTables;
use yii\bootstrap\ActiveForm;
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
                        <li class="breadcrumb-item active">Тестирование функционала</li>
                    </ol>
                </div>
                <h4 class="page-title">Тестирование функционала</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <?php $form = ActiveForm::begin([
                'id' => 'test-functions',
                'method'=>'post',
            ]) ?>
            <div class="pt-3 pb-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="data" value="">
                    <button type="submit" class="input-group-text btn waves-effect waves-light btn-blue"><i class="fa fa-search me-1"></i> Поиск</button>
                </div>
                <div class="mt-3 text-center">
                    <h4>Поиск данных с использованием функции:</h4>
                </div>
                <div class="mt-3 input-group">
                    <input type="number" class="form-control" name="percent" value="70" id="percent">
                    <label class="form-check-label" for="percent">percent</label>
                </div>
                <div class="mt-3 col-sm-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="type" value="php_lev" id="customradio1" checked="">
                        <label class="form-check-label" for="customradio1">PHP - levenshtein</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="type" value="php_sim" id="customradio3">
                        <label class="form-check-label" for="customradio3">PHP - similar_text</label>
                    </div>
                    <div class="form-check mb-2 form-check-success">
                        <input class="form-check-input" type="radio" name="type" value="mysql" id="customradio2">
                        <label class="form-check-label" for="customradio2">MySQL - levenshtein</label>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <dl class="row">
                <dt class="col-sm-3">Время выполнения скрипта</dt>
                <dd class="col-sm-9"><?= $load_time ?></dd>
                <dt class="col-sm-3">Количество объектов</dt>
                <dd class="col-sm-9"><?= count($data) ?></dd>
            </dl>
        </div>
    </div>
    <div class="row">
        <?php if(!empty($data)): ?>
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Данные</h4>
                    <table id="datatable-buttons" class="table table-striped dt-responsive">
                        <thead>
                        <tr>
                            <?php foreach ($data[0] as $assoc => $datum): ?>
                                <td><?= $assoc ?></td>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $datum): ?>
                        <tr>
                            <?php foreach ($datum as $datum_val): ?>
                                <td><?= $datum_val ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        <?php else: ?>
            <h4 class="header-title text-center text-info">Нет пользователей</h4>
        <?php endif; ?>
    </div>
</div>
