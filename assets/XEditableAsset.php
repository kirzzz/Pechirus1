<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class XEditableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin\node_modules\x-editable\dist\bootstrap-editable\css\bootstrap-editable.css',
    ];
    public $js = [
        'admin\node_modules\x-editable\dist\bootstrap3-editable\js\bootstrap-editable.min.js',
        'admin/src/js/pages/form-xeditable-05-29.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}