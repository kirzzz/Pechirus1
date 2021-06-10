<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class AdminDashboard extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "admin/node_modules/flatpickr/dist/flatpickr.min.css",
        "admin/node_modules/selectize/dist/css/selectize.bootstrap3.css",
    ];
    public $js = [
        "admin/node_modules/flatpickr/dist/flatpickr.min.js",
        "admin/node_modules/flatpickr/dist/l10n/ru.js",
        "admin/node_modules/apexcharts/dist/apexcharts.min.js",
        "admin/node_modules/selectize/dist/js/standalone/selectize.min.js",
        "admin/node_modules/waypoints/lib/jquery.waypoints.min.js",
        "admin/node_modules/jquery.counterup/jquery.counterup.min.js",
        "admin/src/js/pages/dashboard-1.init.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}