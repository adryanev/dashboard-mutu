<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 14/09/19
 * Time: 05.56
 */

namespace common\helpers;

use Yii;

class UnitDirectoryHelper implements DirectoryHelper
{

    public static function getPath($id)
    {
        $p = Yii::getAlias('@uploadUnit');
        $replacement = ['{id_unit}'=>$id];
        return strtr($p, $replacement);
    }

    public static function getUrl($id)
    {
        $p = Yii::getAlias('@.uploadUnit');
        $replacement = ['{id_unit}'=>$id];
        return strtr($p, $replacement);
    }
}
