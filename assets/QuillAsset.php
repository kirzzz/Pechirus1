<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class QuillAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin\node_modules\quill\dist\quill.core.css',
        'admin\node_modules\quill\dist\quill.bubble.css',
        'admin\node_modules\quill\dist\quill.snow.css',
    ];
    public $js = [
        'admin\node_modules\quill\dist\quill.min.js',
        'admin/src/js/pages/form-quilljs.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}