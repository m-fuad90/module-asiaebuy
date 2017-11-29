<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'front/vendor/bootstrap/css/bootstrap.min.css',
        'vendor/font-awesome/css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800',
        'https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic',
        'front/css/select2.css',
        'front/vendor/magnific-popup/magnific-popup.css',
        'front/css/creative.css'

    ];
    public $js = [

        'front/js/select.js',
        'front/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'front/vendor/jquery-easing/jquery.easing.min.js',
        'front/vendor/scrollreveal/scrollreveal.min.js',
        'front/vendor/magnific-popup/jquery.magnific-popup.min.js',
        'front/js/creative.min.js',
        'front/js/front.js',

        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
