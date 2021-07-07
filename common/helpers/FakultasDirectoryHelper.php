<?php


namespace common\helpers;


class FakultasDirectoryHelper implements DirectoryHelper
{

    public static function getPath($id)
    {
       $path = \Yii::getAlias('@uploadFakultas');
       $replacement = ['{id_fakultas}'=>$id];
       return strtr($path,$replacement);
    }

    public static function getUrl($id)
    {
        $path = \Yii::getAlias('@.uploadFakultas');
        $replacement = ['{id_fakultas}'=>$id];
        return strtr($path,$replacement);
    }
}