<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class Select2Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin\node_modules\select2\dist\css\select2.min.css',
    ];
    public $js = [
        'admin\node_modules\select2\dist\js\select2.min.js',
        'admin/src/js/pages/form-advanced.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}