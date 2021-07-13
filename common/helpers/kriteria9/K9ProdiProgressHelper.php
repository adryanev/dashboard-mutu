<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */

/**
 * Class K9InstitusiProgressHelper
 * @package common\helpers\kriteria9
 */


namespace common\helpers\kriteria9;


use common\models\Constants;
use Yii;
use yii\helpers\Json;

class K9ProdiProgressHelper implements IK9ProgressHelper
{

    use K9ProgressTrait;


    public static function getDokumenLedProgress($led, $detail, $kriteria)
    {

      return self::hitung($detail,$kriteria,K9ProdiJsonHelper::getJsonKriteriaLed($kriteria));

    }

    public static function getDokumenLkProgress($lk, $dokumen, $kriteria)
    {

        $prodi = $lk->lkProdi->akreditasiProdi->prodi;
        return self::hitung($dokumen, $kriteria,K9ProdiJsonHelper::getJsonKriteriaLk($kriteria,$prodi->jenjang));


    }


}
