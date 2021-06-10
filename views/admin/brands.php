<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $data app\models\Brand[] */
/* @var $model app\models\Brand */
/* @var $file app\models\UploadForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\assets\DropifyAsset;

DropifyAsset::register($this);

$this->title = 'Брэнд';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Брэнд</li>
                    </ol>
                </div>
                <h4 class="page-title">Брэнд</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">
                <?php $form = ActiveForm::begin([
                    'id' => 'catalog-new',
                    'options' => ['enctype' => 'multipart/form-data'],
                    'method'=>'post',
                    //'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                ]) ?>
                <h4 class="header-title">Новый Брэнд</h4>
                <?= isset($model->id)?$form->field($model,'id')->hiddenInput()->label(false):'' ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'description')->textarea() ?>
                <?= $form->field($file, 'imageFile')
                    ->fileInput(["data-plugins"=>"dropify","data-allowed-file-extensions" => "png jpg jpeg"
                        ,"data-max-file-size"=>"10M","data-height"=>"200"
                        ,'data-default-file'=>(isset($model->id) and isset($model->img))?Url::to('@web/'.$model->img):""
                        ,"value"=>(isset($model->id) and isset($model->img))?Url::to('@web/'.$model->img):""])->label('Изображение') ?>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success waves-effect waves-light" data-add><?= isset($model->id)?'Обновить':'Создать' ?></button>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">
                <!--<div class="dropdown float-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                    </div>
                </div>-->

                <h4 class="header-title mb-3">Список Брэндов</h4>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th colspan="2">Наименование</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($data)): foreach ($data as $index=>$datum):?>
                        <tr>
                            <td><?= $datum->id ?></td>
                            <td style="width: 36px;">
                                <img src="<?= $datum->img?Url::to('@web/'.$datum->img):'/images/default/no-image.png'?>" alt="contact-img" style="object-fit: cover" title="contact-img" class="avatar-sm">
                            </td>
                            <td><h5 class="m-0 font-weight-normal"><?= $datum->name ?></h5></td>
                            <td>
                                <a href="<?= Url::to(['admin/brands','id'=>$datum->id,'type'=>'edit']) ?>" class="btn btn-xs btn-info"><i class="fe-edit-1"></i></a>
                                <a href="<?= Url::to(['admin/brands','id'=>$datum->id,'type'=>'delete']) ?>" class="btn btn-xs btn-danger"><i class="fe-trash-2"></i></a>
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
