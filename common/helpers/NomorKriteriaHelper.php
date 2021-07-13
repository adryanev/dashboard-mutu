<?php


namespace common\helpers;

class NomorKriteriaHelper
{

    public static function changeToJsonFormat($param)
    {
        $first = substr($param, 1);
        return str_replace(array('__', '_'), array('-', '.'), $first);
    }

    public static function changeToDbFormat($param)
    {
        $new = str_replace('-', '__', $param);
        return '_' . str_replace('.', '_', $new);
    }
}
