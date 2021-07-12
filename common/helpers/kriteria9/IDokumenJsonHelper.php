<?php


namespace common\helpers\kriteria9;


interface IDokumenJsonHelper
{
   public static function getAllDokumen();

    static function provideMapper();

    public static function getByName($name);
}
