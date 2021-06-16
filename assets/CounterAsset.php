<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class CounterAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        "admin/node_modules/waypoints/lib/jquery.waypoints.min.js",
        "admin/node_modules/jquery.counterup/jquery.counterup.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}