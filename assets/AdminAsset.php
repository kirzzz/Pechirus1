<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin/node_modules/bootstrap/dist/css/bootstrap.min.css',
        'admin/src/css/bootstrap-dark.css',
        'css/fontawesome-pro-5.14.0-web/css/all.min.css',
        'admin/node_modules/jquery-toast-plugin/dist/jquery.toast.min.css',
        'admin/src/css/icons.css',
        'admin/src/css/app-dark.css',
    ];
    public $js = [
        //'node_modules/jquery/dist/jquery.min.js',
        //'node_modules/jquery/dist/jquery.slim.min.js',
        //'admin/node_modules/popper.js/dist/popper.min.js',
        'admin/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        'admin\node_modules\node-waves\dist\waves.min.js',
        'admin/node_modules/feather-icons/dist/feather.min.js',
        'admin\node_modules\jquery-sparkline\jquery.sparkline.min.js',
        'admin/node_modules/jquery-toast-plugin/dist/jquery.toast.min.js',
        //'admin/gulpfile.js',
        'admin/src/js/test.js',
        'admin/src/js/layout.js',
        'admin/src/js/admin.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}