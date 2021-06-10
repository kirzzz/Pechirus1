<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 1.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'site/css/vendor/vendor.min.css',
        'site/css/plugins/plugins.min.css',
        'site/css/plugins/modal.min.css',
        'site/css/catalog-21-06-05.css',
        'site/css/style-21-06-04-2.css',
    ];
    public $js = [
        'site/js/vendor/vendor.js',
        'site/js/plugins/plugins.js',
        'site/js/plugins/modal.min.js',
        'site/js/plugins/catalog.js',
        'site/js/main-21-06-03.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
