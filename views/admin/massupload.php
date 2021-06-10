<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $file app\models\MultiUpload */
/* @var $data_catalog app\models\Catalog[] */
/* @var $unload app\models\MultiUnload */
/* @var $href boolean|string */
/* @var $filename boolean|string */

use app\assets\Select2Asset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\assets\DropifyAsset;

Select2Asset::register($this);
DropifyAsset::register($this);

$this->title = 'Массовая загрузка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Массовая загрузка/выгрузка</li>
                    </ol>
                </div>
                <h4 class="page-title">Массовая загрузка/выгрузка</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">
                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Массовая выгрузка продуктов</h5>
                <div class="card mb-0">
                    <div class="card-header mb-3" id="collapseProductUnloadDescParent">
                        <h5 class="m-0 position-relative">
                            <a class="custom-accordion-title text-reset d-block" data-toggle="collapse" href="#collapseProductUnloadDesc" aria-expanded="true" aria-controls="collapseProductUnloadDesc">
                                Ознакомиться с кратким техническим руководством <i class="mdi mdi-chevron-down accordion-arrow"></i>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseProductUnloadDesc" class="collapse" aria-labelledby="headingFour" data-parent="#collapseProductUnloadDescParent" style="">
                        <div class="card-body">
                            Прежде чем произвести массовую выгрузку продуктов, пожалуйста, ознакомьтесь с кратким техническим руководством<br>
                            Если вы планируете выгрузить продукты из определенного каталога - выберите его в разделе <code>Каталог</code>.<br>
                            Если вам надо выгрузить каталог со всеми его дочерними каталогами (Пример: "ЧУГУННОЕ ЛИТЬЕ" включает в себя "Чугунное литье Fireway", "Чугунное литье Везувий" и т.д) нажмите на переключатель <code>Выгрузка дочерних каталогов</code>.<br>
                            Если вы планируете после использовать этот файл для обновления информации о продуктах то учтите следующие требования:
                            <h4>Требования</h4>
                            <dl class="row">
                                <dt class="col-sm-3">ID</dt>
                                <dd class="col-sm-9">Является обязательном полем, изменение запрещено!</dd>

                                <dt class="col-sm-3">Артикул</dt>
                                <dd class="col-sm-9">Является обязательным полем, изменение запрещено!</dd>

                                <dt class="col-sm-3">Каталог</dt>
                                <dd class="col-sm-9">Не является обязательным параметром, передается в качестве доп. информации. Реадктирование не приведет ни к каким ответным действиям.</dd>

                                <dt class="col-sm-3">Брэнд</dt>
                                <dd class="col-sm-9">Не является обязательным параметром, передается в качестве доп. информации. Реадктирование не приведет ни к каким ответным действиям.</dd>
                            </dl>
                            <strong>Перед загрузкой ознакомьтесь с кратким техническим руководством по загрузке продуктов</strong>
                        </div>
                    </div>
                </div>
                <?php $form = ActiveForm::begin([
                    'id' => 'mass-unload-product',
                    'method'=>'post',
                    'enableClientValidation' => true,
                ]) ?>
                <div class="form-group field-product-idcatalog">
                    <label class="control-label" for="product-idcatalog">Каталог</label>
                    <select data-toggle="select2" name="MultiUnload[idCatalog]" id="multiunload-idcatalog">
                        <option selected="" value="">Все</option>
                        <?php foreach ($data_catalog as $catalog_opt):?>
                            <option value="<?= $catalog_opt->id ?>"><?= $catalog_opt->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?= $form->field($unload, 'child', ['template' => '{input}{label}{error}'
                    ,'options' => ['class' => 'form-group custom-control custom-switch'],'labelOptions' => [ 'class' => 'custom-control-label' ]])
                    ->checkbox(['class'=>'custom-control-input'],false) ?>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success waves-effect waves-light">Выгрузить</button>
                </div>
                <?php ActiveForm::end() ?>
                <?php if($href !== false): ?>
                <a href="/<?= $href ?>" download="<?= explode('/',$href)[count(explode('/',$href))-1] ?>" class="btn btn-success waves-effect waves-light">
                    Скачать <span class="btn-label-right"><i class="fe-file"></i></span>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">
                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Массовая загрузка каталогов</h5>
                <div class="card mb-0">
                    <div class="card-header mb-3" id="collapseCatalogDescParent">
                        <h5 class="m-0 position-relative">
                            <a class="custom-accordion-title text-reset d-block" data-toggle="collapse" href="#collapseCatalogDesc" aria-expanded="true" aria-controls="collapseCatalogDesc">
                                Ознакомиться с кратким техническим руководством <i class="mdi mdi-chevron-down accordion-arrow"></i>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseCatalogDesc" class="collapse" aria-labelledby="headingFour" data-parent="#collapseCatalogDescParent" style="">
                        <div class="card-body">
                            Прежде чем произвести массовую загрузку новых продуктов убедитесь, что вы ознакомились с ниже представленной информацией.<br>
                            Производимое действие по загрузке файла повлечет обновлене перечисленных в нем продуктов. Если вы добавите новый продукт - он не будет создан. Создание продуктов происходит в разделе <code><a href="<?= Url::toRoute(['admin/product']) ?>"></a></code>.<br>
                            <h4>Описание полей</h4>
                            <dl class="row">
                                <dt class="col-sm-3">ID</dt>
                                <dd class="col-sm-9">Уникальный идентификатор продукта. <strong>Изменение запрещено!</strong></dd>

                                <dt class="col-sm-3">Артикул</dt>
                                <dd class="col-sm-9">Уникальный артикул продукта. <strong>Изменение запрещено!</strong></dd>

                                <dt class="col-sm-3">Каталог</dt>
                                <dd class="col-sm-9">Наименование каталога продукта. <strong>Изменение ни на что не влияет.</strong></dd>

                                <dt class="col-sm-3">Брэнд</dt>
                                <dd class="col-sm-9">Наименование Брэнда продукта. <strong>Изменение ни на что не влияет.</strong></dd>

                                <dt class="col-sm-3">Название</dt>
                                <dd class="col-sm-9">Наименование продукта. <strong>Является изменяемым параметром.</strong></dd>

                                <dt class="col-sm-3">Цена</dt>
                                <dd class="col-sm-9">Цена продукта. <strong>Является изменяемым параметром.</strong><strong>Поле не может быть пустым!</strong></dd>

                                <dt class="col-sm-3">Цена закупки</dt>
                                <dd class="col-sm-9">Цена закупки продукта. <strong>Является изменяемым параметром.</strong><strong>Поле не может быть пустым!</strong></dd>

                                <dt class="col-sm-3">Цена со скидкой</dt>
                                <dd class="col-sm-9">Цена со скидкой продукта. Позволяет установить скидку на продукт.<strong>Является изменяемым параметром.</strong><strong>Поле не может быть пустым!</strong></dd>

                                <dt class="col-sm-3">Хар-ки</dt>
                                <dd class="col-sm-9">Хар-ки продукта. <strong>Изменение ни на что не влияет.</strong></dd>

                                <dt class="col-sm-3">Описание</dt>
                                <dd class="col-sm-9">Описание продукта. <strong>Изменение ни на что не влияет.</strong></dd>

                                <dt class="col-sm-3">В наличии</dt>
                                <dd class="col-sm-9">
                                    <p class="mb-2">Описывает наличие продукта в магазине. <strong>Является изменяемым параметром.</strong></p>
                                    <p>Возможные значения:</p>
                                    <dl class="row">
                                        <dt class="col-sm-4">0</dt>
                                        <dd class="col-sm-8">Нет в наличии</dd>
                                        <dt class="col-sm-4">1</dt>
                                        <dd class="col-sm-8">В наличии</dd>
                                    </dl>
                                </dd>

                                <dt class="col-sm-3">Скрыт</dt>
                                <dd class="col-sm-9">
                                    <p class="mb-2">Описывает видимость продукта в магазине. Если скрыт - товар не передается в Маркет!<strong>Является изменяемым параметром.</strong></p>
                                    <p>Возможные значения:</p>
                                    <dl class="row">
                                        <dt class="col-sm-4">0</dt>
                                        <dd class="col-sm-8">Показывать на сайте и передавать в Маркет</dd>
                                        <dt class="col-sm-4">1</dt>
                                        <dd class="col-sm-8">Скрыт</dd>
                                    </dl>
                                </dd>
                            </dl>
                            <strong>Скачать <a download="example" href="/multiupload/example/example.xlsx">Шаблон</a></strong>
                        </div>
                    </div>
                </div>
                <?php $form = ActiveForm::begin([
                    'id' => 'multiupload-catalog',
                    'options' => ['enctype' => 'multipart/form-data'],
                    'method'=>'post',
                    'enableClientValidation' => true,
                ]) ?>
                <?= $form->field($file, 'excel')->fileInput(["data-plugins"=>"dropify","data-allowed-file-extensions" => "xlsx xls","data-height"=>"200"])->label('Загрузите файл') ?>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success waves-effect waves-light" data-add>Загрузить</button>
                </div>
                <?php ActiveForm::end() ?>
                <?php if($filename !== false): ?>
                    <a href="/<?= $filename ?>" download="<?= explode('/',$filename)[count(explode('/',$filename))-1] ?>" class="btn btn-success waves-effect waves-light">
                        Скачать отчет<span class="btn-label-right"><i class="fe-file"></i></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
