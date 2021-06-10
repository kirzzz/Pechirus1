<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $data app\models\Catalog[] */
/* @var $model app\models\Catalog */
/* @var $file app\models\UploadForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\assets\DropifyAsset;
use app\assets\NestableAsset;
use app\assets\XEditableAsset;

DropifyAsset::register($this);
XEditableAsset::register($this);
NestableAsset::register($this);

$this->title = 'Главная';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">Каталог</li>
                    </ol>
                </div>
                <h4 class="page-title">Каталог</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left" id="nestable_list_menu">
                <button type="button" class="btn btn-blue btn-sm waves-effect mb-3 waves-light" data-action="expand-all">Развернуть все</button>
                <button type="button" class="btn btn-pink btn-sm waves-effect mb-3 waves-light" data-action="collapse-all">Свернуть все</button>
            </div>
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <?php $form = ActiveForm::begin([
                            'id' => 'catalog-new',
                            'options' => ['enctype' => 'multipart/form-data'],
                            'method'=>'post',
                            //'enableAjaxValidation' => true,
                            'enableClientValidation' => true,
                        ]) ?>
                        <h4 class="header-title">Новый раздел</h4>
                        <?= isset($model->id)?$form->field($model,'id')->hiddenInput()->label(false):'' ?>
                        <?= $form->field($model, 'name') ?>
                        <?= $form->field($model, 'status')->radioList([0 => 'Скрытый', 1 => 'Активный'],
                            [
                                'item' => function($index, $label, $name, $checked, $value) {

                                    $return = '<div class="radio radio-'.($value?"success":"danger ml-1").' form-check-inline">';
                                    $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" id="radio-status-' . $value . '" '.$checked.'>';
                                    $return .= '<label for="radio-status-' . $value . '">' . ucwords($label) . '</label>';
                                    $return .= '</div>';

                                    return $return;
                                }
                            ]) ?>
                        <?= $form->field($file, 'imageFile')
                            ->fileInput(["data-plugins"=>"dropify","data-allowed-file-extensions" => "png jpg jpeg"
                                ,"data-max-file-size"=>"10M","data-height"=>"200"
                                ,'data-default-file'=>(isset($model->id) and isset($model->img))?Url::to('@web/'.$model->img):""
                                ,"value"=>(isset($model->id) and isset($model->img))?Url::to('@web/'.$model->img):""])->label('Изображение') ?>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light" data-add>Добавить</button>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <?php ActiveForm::begin() ?>
                        <h4 class="header-title">Структура каталога</h4>
                        <p class="sub-header">
                            Перетаскивайте пункты каталога так, как вам угодно.
                        </p>
                        <div class="custom-dd-empty dd" id="nestable_list_3" style="max-width: 100%">
                            <?php
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
                            function showTree($arr,$data){
                                echo '<ol class="dd-list">';
                                foreach($arr as $key => $v) {
                                    $item = $data[array_search($key,array_column($data,'article'))];
                                    echo '<li class="dd-item dd3-item" data-id="'.$item['article'].'" data-name="'.$item['name'].'" data-status="'.$item['status'].'">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content">
                                                    <a href="#" style="color: #dee2e6" class="inline-catalog-name" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Название">'.$item['name'].'</a>
                                                    <a href="#" class="inline-catalog-status" data-type="select" data-pk="1" data-value="'.$item['status'].'" data-title="Статус"></a>
                                                    <div class="dropdown float-right">
                                                        <a href="#" style="line-height: normal;" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"></a>
                                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                                            <a href="'.Url::to(['admin/catalogs','id'=>$item['id'],'type'=>'edit']).'" class="dropdown-item"><i class="fe-edit-1 mr-2"></i>Изменить</a>
                                                            <a href="'.Url::to(['admin/catalogs','id'=>$item['id'],'type'=>'delete']).'" class="dropdown-item"><i class="fe-trash-2 mr-2"></i>Удалить</a>
                                                            <a class="dropdown-item" data-catalog-product-visible="0" data-catalog-product-visible-id="'.$item['id'].'"><i class="fe-eye mr-2"></i>Открыть продукты</a>
                                                            <a class="dropdown-item" data-catalog-product-visible="1" data-catalog-product-visible-id="'.$item['id'].'"><i class="fe-eye-off mr-2"></i>Скрыть продукты</a>
                                                        </div>
                                                    </div>
                                                </div>';
                                    if(!is_array($v)){
                                        echo '</li>';
                                    }else{
                                        echo '<ol class="dd-list">'. showTree($v,$data) . '</ol></li>';
                                    }
                                }
                                echo '</ol>';
                            }
                            $tree = CreateTree($data);
                            showTree($tree,$data);
                            ?>
                        </div>
                        <input type="hidden" name="Catalog[output]" id="nestable-output">
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Сохранить</button>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div><!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
</div>

