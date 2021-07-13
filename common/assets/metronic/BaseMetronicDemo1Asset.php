<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 9/30/2019
 * Time: 10:13 PM
 */

namespace common\assets\metronic;

class BaseMetronicDemo1Asset extends \yii\web\AssetBundle
{

    public $sourcePath = '@common/assets/metronic/assets';


    public $css = [
        'css/skins/header/base/light.css',
        'css/skins/header/menu/light.css',
        'css/skins/brand/dark.css',
        'css/skins/aside/dark.css'
    ];

    public $depends = [
        BaseMetronicAsset::class
    ];
}
