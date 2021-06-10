<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $data app\models\Provider[] */
/* @var $model app\models\Provider */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Поставщик';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Поставщик</li>
                    </ol>
                </div>
                <h4 class="page-title">Поставщик</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <?php $form = ActiveForm::begin([
                            'id' => 'provider-new',
                            'method'=>'post',
                            'enableClientValidation' => true,
                        ]) ?>
                        <h4 class="header-title">Создать Поставщика</h4>
                        <?= isset($model->id)?$form->field($model,'id')->hiddenInput()->label(false):'' ?>
                        <?= $form->field($model, 'codeProvider') ?>
                        <?= $form->field($model, 'name') ?>
                        <?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+7(999)-999-9999',
                        ]) ?>
                        <?= $form->field($model, 'email')->input('email') ?>
                        <?= $form->field($model, 'address') ?>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light" data-add><?= isset($model->id)?'Обновить':'Создать' ?></button>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">
                <h4 class="header-title mb-3">Список Поставщиков</h4>
                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>Код</th>
                            <th>Наименование</th>
                            <th>Телефон</th>
                            <th>email</th>
                            <th>Адресс</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($data)): foreach ($data as $index=>$datum):?>
                            <tr>
                                <td><?= $index+1 ?></td>
                                <td><h5 class="m-0 font-weight-normal"><?= $datum->name ?></h5></td>
                                <td><?= $datum->tel ?></td>
                                <td><?= $datum->email ?></td>
                                <td><?= $datum->address ?></td>
                                <td>
                                    <a href="<?= Url::to(['admin/provider','id'=>$datum->id,'type'=>'edit']) ?>" class="btn btn-xs btn-info"><i class="fe-edit-1"></i></a>
                                    <a href="<?= Url::to(['admin/provider','id'=>$datum->id,'type'=>'delete']) ?>" class="btn btn-xs btn-danger"><i class="fe-trash-2"></i></a>
                                </td>
                            </tr>
                        <?php endforeach;endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
