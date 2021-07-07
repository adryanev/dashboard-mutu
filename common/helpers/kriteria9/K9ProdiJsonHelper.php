<?php
/**
 * Project: kriteria.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/4/2019
 * Time: 9:24 AM
 */

namespace common\helpers\kriteria9;

use common\models\kriteria9\led\Led;
use common\models\kriteria9\lk\Lk;
use common\models\kriteria9\penilaian\Penilaian;
use JsonMapper;
use Yii;
use yii\helpers\Json;

class K9ProdiJsonHelper implements IK9JsonHelper
{

    static function provideMapper()
    {
        return new JsonMapper();
    }

    public static function getAllJsonLk($jenis)
    {
        $out = [];
        $json = self::getJson('lk', $jenis);
        foreach ($json as $jsonObj) {
            $out[] = self::provideMapper()->map($jsonObj, new Lk());
        }

        return $out;
    }

    public static function getJson($tipe, $jenis = '')
    {
        $filename = '';
        switch ($tipe) {
            case 'led':
                $filename = 'led_prodi.json';
                break;
            case 'lk':
                $filename = "lkps_prodi_$jenis.json";
                break;
            case 'penilaian':
                $filename = 'penilaian_prodi_' . $jenis . '.json';
                break;
        }
        $path = Yii::getAlias('@required/kriteria9/aps/' . $filename);
        return Json::decode(file_get_contents($path), false);
    }

    public static function getJsonKriteriaLk(int $kriteria, string $jenis)
    {
        $json = self::getJson('lk', $jenis)[$kriteria - 1];
        return self::provideMapper()->map($json, new Lk());
    }

    public static function getAllJsonLed($jenis = '')
    {
        return self::provideMapper()->map(self::getJson('led')[2], new Led());
    }

    /**
     * @param int $kriteria
     * @return mixed|Led
     * @throws \JsonMapper_Exception
     */
    public static function getJsonKriteriaLed(int $kriteria)
    {
        return self::provideMapper()->map(self::getJson('led')[2]->butir[$kriteria - 1], new Led());
    }

    public static function getJsonLedKondisiEksternal()
    {
        return self::provideMapper()->map(self::getJson('led')[0], new Led());
    }

    public static function getJsonLedProfil()
    {
        return self::provideMapper()->map(self::getJson('led')[1], new Led());
    }

    public static function getJsonLedAnalisis()
    {
        return self::provideMapper()->map(self::getJson('led')[3], new Led());
    }

    public static function getJsonPenilaianKondisiEksternal($jenis)
    {
        return self::provideMapper()->map(self::getJson('penilaian', $jenis)[0], new Penilaian());
    }

    public static function getJsonPenilaianProfil($jenis)
    {
        return self::provideMapper()->map(self::getJson('penilaian', $jenis)[1], new Penilaian());

    }

    public static function getJsonPenilaianKriteria($jenis)
    {
        return self::provideMapper()->map(self::getJson('penilaian', $jenis)[2], new Penilaian());
    }

    public static function getJsonPenilaianAnalisis($jenis)
    {
        return self::provideMapper()->map(self::getJson('penilaian', $jenis)[3], new Penilaian());

    }
}
