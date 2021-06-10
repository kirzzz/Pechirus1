<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class NestableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin\node_modules\nestable2\dist\jquery.nestable.min.css',
    ];
    public $js = [
        'admin\node_modules\nestable2\jquery.nestable.js',
        'admin/src/js/pages/nestable.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}