<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $file app\models\MultiUpload */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\assets\DropifyAsset;

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
                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Массовая загрузка продуктов</h5>
                <div class="card mb-0">
                    <div class="card-header mb-3" id="collapseProductDescParent">
                        <h5 class="m-0 position-relative">
                            <a class="custom-accordion-title text-reset d-block" data-toggle="collapse" href="#collapseProductDesc" aria-expanded="true" aria-controls="collapseProductDesc">
                                Ознакомьтся с кратким техническим руководством <i class="mdi mdi-chevron-down accordion-arrow"></i>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseProductDesc" class="collapse" aria-labelledby="headingFour" data-parent="#collapseProductDescParent" style="">
                        <div class="card-body">
                            Прежде чем произвести массовую загрузку новых продуктов убедитесь, что ваш excel файл соответствует шаблону.<br>
                            Поле <code>id</code> заполняется автоматически.<br>
                            Для красивого оформления описания (поле <code>Description</code>) продуктов воспользуйтесь сайтом <a href="https://html-online.com/editor/">HTML-Editor online</a> или другим аналогом.<br>
                            В поле <code>img</code> указывайте ссылки на изображения через запятую. Для получения ссылок на изображения можете воспользоваться сайтом <a href="https://ru.imgbb.com/">imgbb.com</a><br>
                            Поле <code>property</code> заполняется в формате "Наименование параметра [:] Значение || Наименование параметра [:] Значение ...".<br><br>
                            <h4>Описание полей</h4>
                            <dl class="row">
                                <dt class="col-sm-3">id</dt>
                                <dd class="col-sm-9">Уникальный идентификатор продукта</dd>

                                <dt class="col-sm-3">article</dt>
                                <dd class="col-sm-9">Уникальный артикул продукта <strong>(Обязательное поле)</strong></dd>

                                <dt class="col-sm-3">idCatalog</dt>
                                <dd class="col-sm-9"><code>id</code> каталога в котором будет располагаться данный товар <strong>(Обязательное поле)</strong></dd>

                                <dt class="col-sm-3 text-truncate">idBrand</dt>
                                <dd class="col-sm-9">
                                    <code>id</code> брэнда к которому относится данный товар
                                    <footer class="blockquote-footer">
                                        <code>id</code> брэнда вы можете узнать на вкладке <a href="<?= Url::to('admin/brands') ?>">"Брэнды"</a><br>
                                        Также заместо <code>id</code> брэнда вы можете указать его наименование <strong>С УЧЕТОМ РЕГИСТРА</strong>
                                    </footer>
                                </dd>

                                <dt class="col-sm-3">name</dt>
                                <dd class="col-sm-9">Наименование продукта <strong>(Обязательное поле)</strong></dd>

                                <dt class="col-sm-3">price</dt>
                                <dd class="col-sm-9">Цена продукта <strong>(Обязательное поле)</strong></dd>

                                <dt class="col-sm-3">purchasePrice</dt>
                                <dd class="col-sm-9">Цена закупки продукта</dd>

                                <dt class="col-sm-3">description</dt>
                                <dd class="col-sm-9">Описание продукта</dd>

                                <dt class="col-sm-3">property</dt>
                                <dd class="col-sm-9">Характеристики продукта</dd>

                                <dt class="col-sm-3">img</dt>
                                <dd class="col-sm-9">Изображения продукта <strong>(Обязательное поле)</strong></dd>

                                <dt class="col-sm-3">status</dt>
                                <dd class="col-sm-9">
                                    <p class="mb-2">Статус продукта <strong>(Обязательное поле)</strong></p>
                                    <dl class="row">
                                        <?php foreach ((new \app\models\Product)->getStatus() as $index=>$desc):?>
                                        <dt class="col-sm-4"><?= $index ?></dt>
                                        <dd class="col-sm-8"><?= $desc ?></dd>
                                        <?php endforeach; ?>
                                    </dl>
                                </dd>

                                <dt class="col-sm-3">img</dt>
                                <dd class="col-sm-9">Изображения продукта <strong>(Обязательное поле)</strong></dd>

                                <dt class="col-sm-3">count</dt>
                                <dd class="col-sm-9">Количество товара</dd>
                            </dl>

                            <strong>Скачать <a download="example" href="<?=Url::to('@web/multiupload/example/example_product.xlsx')?>">Шаблон</a></strong>
                        </div>
                    </div>
                </div>
                <?php $form = ActiveForm::begin([
                    'id' => 'multiupload-product',
                    'options' => ['enctype' => 'multipart/form-data'],
                    'method'=>'post',
                    'enableClientValidation' => true,
                ]) ?>
                <?= $form->field($file, 'excel')->fileInput(["data-plugins"=>"dropify","data-allowed-file-extensions" => "xlsx xls","data-height"=>"200"])->label('Загрузите файл') ?>
                <?= $form->field($file, 'type')->hiddenInput(['value'=>$file::TYPE_PRODUCT])->label(false) ?>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success waves-effect waves-light" data-add>Загрузить</button>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">
                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Массовая загрузка каталогов</h5>
                <div class="card mb-0">
                    <div class="card-header mb-3" id="collapseCatalogDescParent">
                        <h5 class="m-0 position-relative">
                            <a class="custom-accordion-title text-reset d-block" data-toggle="collapse" href="#collapseCatalogDesc" aria-expanded="true" aria-controls="collapseCatalogDesc">
                                Ознакомьтся с кратким техническим руководством <i class="mdi mdi-chevron-down accordion-arrow"></i>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseCatalogDesc" class="collapse" aria-labelledby="headingFour" data-parent="#collapseCatalogDescParent" style="">
                        <div class="card-body">
                            Прежде чем произвести массовую загрузку новых каталогов убедитесь, что ваш excel файл соответствует шаблону.<br>
                            Поле <code>ID</code> заполняется автоматически у новых каталогов.<br>
                            Поле <code>article</code> заполняется как автоматически, так и вручную. Если каталог с таким <code>article</code> уже существует, то <code>article</code> у нового каталога изменится на уникальный<br>
                            В поле <code>idParent</code> указывается артикул родительского каталога (артикул нужного вам каталога вы можете узнать выгрузив их)<br>
                            Поле <code>idParent</code> является обязательным, если каталог является дочерним.<br>
                            В поле <code>img</code> указывайте ссылки на изображения через запятую. Для получения ссылок на изображения можете воспользоваться сайтом <a href="https://ru.imgbb.com/">imgbb.com</a><br>
                            Для редактирования уже созданных каталогов укажите их <code>ID</code> и заполните поля, которые хотите изменить. <code>ID</code> нужного вам каталога вы можете узнать выгрузив их.<br>
                            Можно комбинировать загрузку и обновление каталогов в одном файле.<br><br>
                            <h4>Описание полей</h4>
                            <dl class="row">
                                <dt class="col-sm-3">id</dt>
                                <dd class="col-sm-9">Уникальный идентификатор каталога</dd>

                                <dt class="col-sm-3">name</dt>
                                <dd class="col-sm-9">Наименование каталога<strong>(Обязательное поле)</strong></dd>

                                <dt class="col-sm-3">img</dt>
                                <dd class="col-sm-9">Изображение каталога</dd>

                                <dt class="col-sm-3 text-truncate">idParent</dt>
                                <dd class="col-sm-9"><code>article</code> каталога в котором находится данный каталог</dd>

                                <dt class="col-sm-3">article</dt>
                                <dd class="col-sm-9">Уникальный артикул каталога <strong>(Обязательное поле)</strong></dd>

                                <dt class="col-sm-3">status</dt>
                                <dd class="col-sm-9">
                                    <p class="mb-2">Статус каталога <strong>(Стандартное значени - "Активный")</strong></p>
                                    <dl class="row">
                                        <dt class="col-sm-4">0</dt>
                                        <dd class="col-sm-8">Скрытый</dd>
                                        <dt class="col-sm-4">1</dt>
                                        <dd class="col-sm-8">Активный</dd>
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
                <?= $form->field($file, 'type')->hiddenInput(['value'=>$file::TYPE_CATALOG])->label(false) ?>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success waves-effect waves-light" data-add>Загрузить</button>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
