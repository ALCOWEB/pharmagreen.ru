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

       // 'css/bootstrap.min.css',
        'css/owl.carousel.min.css',
        'css/slick.css',
        'css/magnific-popup.css',
        'css/font.awesome.css',
        'css/ionicons.min.css',
        'css/linearicons.css',
        'css/animate.css',
        'css/jquery-ui.min.css',
        'css/slinky.menu.css',
        'css/plugins.css',
        'css/style.css',

    ];
    public $js = [
        //'js/common.js',
        'js/vendor/modernizr-3.7.1.min.js',
        'js/popper.js',
        'js/owl.carousel.min.js',
        'js/slick.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/jquery.counterup.min.js',
        'js/jquery.countdown.js',
        'js/jquery.ui.js',
        'js/jquery.elevatezoom.js',
        'js/isotope.pkgd.min.js',
        'js/slinky.menu.js',
        'js/plugins.js',
        'js/main.js',
        'js/ajaxrequests.js'
        ];
    public $depends = [
                //'frontend\assets\FontAwesomeAsset', //Чёт не работали иконки, пришлось напрямую закинуть их
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',

    ];
}