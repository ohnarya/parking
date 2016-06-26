<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class SearchAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    
    public $jsOptions = ['position' => \yii\web\View::POS_END];    
    public $js = [
        'js/search.js'
    ];
    public $depends = [
        '\yii\web\JqueryAsset',
    ];
}
?>