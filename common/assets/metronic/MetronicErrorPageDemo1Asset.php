<?php


namespace common\assets\metronic;


use dominus77\sweetalert2\assets\SweetAlert2Asset;
use yii\web\AssetBundle;

class MetronicErrorPageDemo1Asset extends AssetBundle
{
    public $sourcePath = '@common/assets/metronic/assets';

    public $depends = [BaseMetronicDemo1Asset::class, SweetAlert2Asset::class];

    public $css = [
        'css/pages/general/error/error-6.css'
    ];

    public $js = [
        'js/scripts.bundle.js',
        'js/pages/my-script.js'


    ];

}
