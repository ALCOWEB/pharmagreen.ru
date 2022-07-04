<?php
namespace frontend\assets;
use yii\web\AssetBundle;
/**
 * Main frontend application asset bundle.
 */
class InnSearchAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
      public $css = [

        'https://cdn.jsdelivr.net/jquery.suggestions/17.2/css/suggestions.css',
   

    ];
    public $js = [
     
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js',
        'https://cdn.jsdelivr.net/jquery.suggestions/17.2/js/jquery.suggestions.min.js',
        
        ];
    public $depends = [
                //'frontend\assets\FontAwesomeAsset', //Чёт не работали иконки, пришлось напрямую закинуть их
        'frontend\assets\AppAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',

    ];
}