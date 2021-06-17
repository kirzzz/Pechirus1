<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class StealAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'admin/node_modules/chart.js/dist/Chart.bundle.min.js',
        'web/admin/node_modules/moment/min/moment.min.js',
        'web/admin/node_modules/jquery.scrollto/jquery.scrollTo.min.js',
        'web/admin/src/js/pages/dashboard-3.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}