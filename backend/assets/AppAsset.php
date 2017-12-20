<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /*'metronic5/vendors/base/vendors.bundle.css',
        'metronic5/demo/demo3/base/style.bundle.css',
        'css/font.css' */

        'adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'adminlte/bower_components/font-awesome/css/font-awesome.min.css',
        'adminlte/bower_components/Ionicons/css/ionicons.min.css',
        'adminlte/bower_components/jvectormap/jquery-jvectormap.css',
        'adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css',
        'adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        'adminlte/dist/css/AdminLTE.min.css',
        'adminlte/dist/css/skins/_all-skins.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic',
        'css/site.css',


    ];
    public $js = [
       /* 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js',
        'metronic5/vendors/base/vendors.bundle.js',
        'metronic5/demo/demo3/base/scripts.bundle.js',
        'metronic5/app/js/dashboard.js',
        'js/js.js',*/

        'adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js',
        'adminlte/bower_components/fastclick/lib/fastclick.js',
        'adminlte/dist/js/adminlte.min.js',
        'adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js',
        'adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'adminlte/bower_components/Chart.js/Chart.js',
        'adminlte/dist/js/pages/dashboard2.js',
        'adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js',
        'adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        'adminlte/dist/js/demo.js',


        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
