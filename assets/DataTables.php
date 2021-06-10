<?php


namespace app\assets;


use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Kirzzz <shcherbach00@mail.ru>
 * @since 2.0
 */
class DataTables extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin\node_modules\datatables.net-bs4\css\dataTables.bootstrap4.min.css',
        'admin\node_modules\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css',
        'admin\node_modules\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css',
        'admin\node_modules\datatables.net-select-bs4\css\select.bootstrap4.min.css',
    ];
    public $js = [
        "admin/node_modules/datatables.net/js/jquery.dataTables.min.js",
        "admin/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js",
        "admin/node_modules/datatables.net-responsive/js/dataTables.responsive.min.js",
        "admin/node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js",
        "admin/node_modules/datatables.net-buttons/js/dataTables.buttons.min.js",
        "admin/node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js",
        "admin/node_modules/datatables.net-buttons/js/buttons.html5.min.js",
        "admin/node_modules/datatables.net-buttons/js/buttons.flash.min.js",
        "admin/node_modules/datatables.net-buttons/js/buttons.print.min.js",
        "admin/node_modules/datatables.net-keytable/js/dataTables.keyTable.min.js",
        "admin/node_modules/datatables.net-select/js/dataTables.select.min.js",
        "admin/node_modules/pdfmake/build/pdfmake.min.js",
        "admin/node_modules/pdfmake/build/vfs_fonts.js",
        'admin/src/js/pages/datatables.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}