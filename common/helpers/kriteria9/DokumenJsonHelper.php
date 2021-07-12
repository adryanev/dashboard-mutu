<?php


namespace common\helpers\kriteria9;


use common\models\kriteria9\dokumentasi\Dokumentasi;
use JsonMapper;
use yii\helpers\Json;
use yii2mod\collection\Collection;

class DokumenJsonHelper implements IDokumenJsonHelper
{

    public static function getAllDokumen()
    {
        $out = [];
        $json = self::getJson();

        foreach ($json as $data){
            $out[] = self::provideMapper()->map($data, new Dokumentasi());
        }
        return $out;
    }

    static function provideMapper()
    {
        return new JsonMapper();
    }

    private static function getJson()
    {
        $path = \Yii::getAlias('@required/kriteria9/aps/dokumen.json');
        return Json::decode(file_get_contents($path),false);
    }

    public static function getByName($name)
    {
        $dokumen = self::getAllDokumen();
        $collection = Collection::make($dokumen);
        return $collection->where('dokumen',$name)->values()->first();
    }
}
