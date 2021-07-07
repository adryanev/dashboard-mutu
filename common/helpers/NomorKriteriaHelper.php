<?php


namespace common\helpers;

class NomorKriteriaHelper
{

    public static function changeToJsonFormat($param)
    {
        $first = substr($param, 1);
        $temp = str_replace('__', '-', $first);
        return str_replace('_', '.', $temp);
    }

    public static function changeToDbFormat($param)
    {
        $new = str_replace('-', '__', $param);
        return '_' . str_replace('.', '_', $new);
    }
}
