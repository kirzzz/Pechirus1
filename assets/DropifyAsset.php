<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class DropifyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin\node_modules\dropify\dist\css\dropify.min.css',
    ];
    public $js = [
        'admin\node_modules\dropify\dist\js\dropify.min.js',
        'admin/src/js/pages/form-fileuploads.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}