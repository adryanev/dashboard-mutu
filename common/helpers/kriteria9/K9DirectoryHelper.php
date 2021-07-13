<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */

/**
 * Class K9DirectoryHelper
 * @package common\helpers\kriteria9
 */


namespace common\helpers\kriteria9;


abstract class K9DirectoryHelper implements IK9DirectoryHelper
{

    public static function getTemplateLk($replacement)
    {
        $pathData = \Yii::$app->params['templatePath'];


        $result = strtr($pathData, $replacement);

        return $result;
    }

}
