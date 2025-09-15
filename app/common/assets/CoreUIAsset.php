<?php
namespace common\assets;

use yii\web\AssetBundle;

class CoreUiAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css = [
        'https://cdn.jsdelivr.net/npm/@coreui/coreui@5/dist/css/coreui.min.css',
        'https://cdn.jsdelivr.net/npm/@coreui/icons/css/all.min.css',
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/@coreui/coreui@5/dist/js/coreui.bundle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset', 
    ];
}
