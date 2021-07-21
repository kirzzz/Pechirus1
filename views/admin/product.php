<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Product */
/* @var $data_brands app\models\Brand[] */
/* @var $data_catalog app\models\Catalog[] */


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\assets\Select2Asset;
use app\assets\QuillAsset;

Select2Asset::register($this);
QuillAsset::register($this);


$data_brands = ArrayHelper::map($data_brands,'id','name');
function CreateTree($array,$sub=0){
    $a = array();
    foreach($array as $v) {
        if($sub == $v['idParent']) {
            $b = CreateTree($array,$v['article']);
            if(!empty($b))
                $a[$v['article']] = $b;
            else
                $a[$v['article']] = $v['name'];
        }
    }
    return $a;
}

function showTree($arr,$data,$model,$level = 0){
    $a = '';
    foreach($arr as $key => $v) {
        $item = $data[array_search($key,array_column($data,'article'))];
        if(!is_array($v)){
            $a.= '<option '.((isset($model->idCatalog) and $model->idCatalog == $item['id'])?'selected':'').' value="'.$item['id'].'">'.str_repeat('&nbsp;',$level*4).$item['name'].'</option>';
        }else{
            $a.= '<optgroup label="'.str_repeat('&nbsp;',$level*4).$item['name'].'">'. showTree($v,$data,$model,$level+1) . '</optgroup>';
        }
    }
    return $a;
}

$this->title = 'Продукт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Продукт</li>
                    </ol>
                </div>
                <h4 class="page-title">Добавить/Обновить продукт</h4>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'product-new',
        'options' => ['enctype' => 'multipart/form-data','class'=>'row'],
        'method'=>'post',
        'enableClientValidation' => true,
    ]) ?>
    <div class="col-lg-6">
        <div class="card-box">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Основные</h5>
            <?= isset($model->id)?$form->field($model,'id')->hiddenInput()->label(false):'' ?>
            <?= $form->field($model, 'name') ?>
            <div class="form-row">
                <?= $form->field($model, 'price', ['options' => ['class' => 'form-group col-md-4']]) ?>
                <?= $form->field($model, 'purchasePrice', ['options' => ['class' => 'form-group col-md-4']]) ?>
                <?= $form->field($model, 'new_price', ['options' => ['class' => 'form-group col-md-4']]) ?>
            </div>
            <div class="form-row">
                <?= $form->field($model, 'article', ['options' => ['class' => 'form-group col-md-6']]) ?>
                <?= $form->field($model, 'count', ['options' => ['class' => 'form-group col-md-6']]) ?>
            </div>
            <?= $form->field($model, 'status')->dropDownList($model->getStatus(),[
                'prompt' => 'Выберите статус',
                'data-toggle'=>"select2"
            ]); ?>
            <?= $form->field($model, 'in_stock', ['template' => '{input}{label}{error}'
                ,'options' => ['class' => 'form-group custom-control custom-switch'],'labelOptions' => [ 'class' => 'custom-control-label' ]])
                ->checkbox(['class'=>'custom-control-input'],false) ?>
            <?= $form->field($model, 'hidden', ['template' => '{input}{label}{error}'
                ,'options' => ['class' => 'form-group custom-control custom-switch'],'labelOptions' => [ 'class' => 'custom-control-label' ]])
                ->checkbox(['class'=>'custom-control-input'],false) ?>
            <?= $form->field($model, 'idBrand')->dropDownList($data_brands,[
                'prompt' => 'Выберите Брэнд',
                'data-toggle'=>"select2"
            ]); ?>
            <div class="form-group field-product-idcatalog required has-error">
                <label class="control-label" for="product-idcatalog">Каталог</label>
                <select data-toggle="select2" name="Product[idCatalog]" id="product-idcatalog">
                    <option selected="selected">Выберите каталог</option>
                    <?= showTree(CreateTree($data_catalog),$data_catalog,$model) ?>
                </select>
            </div>
            <div class="form-group field-snow-editor has-success">
                <label class="control-label" for="snow-editor">Описание</label>
                <div id="snow-editor" style="height: 280px"><?= isset($model->description)?$model->description:'' ?></div>
                <?= Html::error($model,'description', ['class' => 'help-block help-block-error']); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-box">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Изображения продукта</h5>
            <div class="form-group mb-3">
                <label>Изображения</label>
                <?php
                $url = $model->article;
                echo \kato\DropZone::widget(['uploadUrl' =>Url::to(['admin/upload', 'id' => $url]),
                    'options' => [
                        'paramName'=>'imageFile',
                        'maxFilesize' => '10',
                        'dictFileTooBig' => 'Файл должен быть не более 10 мб',
                        'maxFiles' => '15',
                        'dictDefaultMessage' => '<i class="h1 text-muted dripicons-cloud-upload"></i>
                                        <h3>Перетащите файлы или выберите их самостоятельно</h3>
                                    <span class="text-muted font-13"></span>',
                        'dictMaxFilesExceeded' => 'Максимально за 1 раз можно загрузить не более 15 файлов',
                        'acceptedFiles' => '.jpg,.jpeg,.png',
                        'dictInvalidFileType' => 'Допускаются только картинки в форматах jpeg, png, jpg',
                        'url' => \Yii::$app->getUrlManager()->createUrl(['admin/upload']),
                        'previewsContainer'=>'#file-previews',
                        'previewTemplate'=> '<div class="card mt-1 mb-0 shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img data-dz-thumbnail="" src="#" class="avatar-sm rounded bg-light" alt="">
                                    </div>
                                    <div class="col pl-0" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                        <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name=""></a>
                                        <p class="mb-0" data-dz-size=""></p>
                                    </div>
                                    <div class="col-auto">
                                        <!-- Button -->
                                        <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove="">
                                            <i class="dripicons-cross"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>',
                    ],
                    'clientEvents' => [
                            'sending'=>"function(file, xhr, formData) {
                              formData.append('id', '".$url."');
                            }",
                            'complete' => "function(file){
                                if(file.status == 'success'){
                                    let val = $('input#product-img').val();
                                    if(val == '')
                                        val = [];
                                    else
                                        val = JSON.parse(val);
                                    val.push({'name':file.name,'path':file.xhr.response,'size': file.size});
                                    $('input#product-img').val(JSON.stringify(val));
                                    file.previewElement.querySelector('img').src = '/' + file.xhr.response;
                                }
                            }",
                            'removedfile' => "function(file){
                                let val = $('input#product-img').val();
                                val = JSON.parse(val);
                                const index = val.map(val => val['name']).indexOf(file.name);
                                if (index > -1) {
                                  val.splice(index, 1);
                                }
                                $('input#product-img').val(JSON.stringify(val));
                            }"
                    ]]);
                ?>

                <div class="dropzone-previews mt-3" id="file-previews">
                </div>
            </div>
        </div>
        <div class="card-box">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Информация о продукте</h5>
            <?= $form->field($model, 'description',['options' =>['class'=>'d-none']])->textarea() ?>
            <div class="form-group mb-3">
                <label>Характеристики</label>
                <div class="input-group">
                    <input type="text" data-option-product="name" class="form-control col-md-4" placeholder="Наименование характеристики">
                    <input type="text" data-option-product="val" class="form-control" placeholder="Значение">
                    <div class="input-group-append">
                        <button class="btn btn-soft-success waves-effect waves-light" type="button" id="option-add"><i class="fe-plus"></i></button>
                    </div>
                </div>
                <?= Html::error($model,'property', ['class' => 'help-block help-block-error']); ?>
            </div>
            <div class="form-group mb-3 <?= isset($model->property)?'':'d-none' ?>" id="options-container">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>Наименование характеристики</th>
                        <th>Значение</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($model->property)):
                        $property = json_decode($model->property,true);
                        foreach ($property['myrows'] as $prop): ?>
                            <tr>
                                <td><?= $prop['name'] ?></td>
                                <td><?= $prop['value'] ?></td>
                                <td>
                                    <button type="button" data-option-product="delete" class="btn btn-danger btn-xs waves-effect waves-light float-right">
                                        <i class="fe-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
            <?= $form->field($model, 'img',['options' =>['class'=>'d-none']])->hiddenInput() ?>
            <?= $form->field($model, 'property',['options' =>['class'=>'d-none']])->hiddenInput() ?>
            <div class="form-group mb-3">
                <?= $form->errorSummary($model,['class'=>'text-danger']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
    <div class="row">
        <div class="col-12">
            <div class="text-center mb-3">
                <button type="submit" form="product-new" class="btn btn-block btn-success waves-effect waves-light" data-add><?= isset($model->id)?'Обновить':'Создать' ?></button>
            </div>
        </div> <!-- end col -->
    </div>
</div>