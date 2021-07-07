<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */

/**
 * Class K9InstitusiDirectoryHelper
 * @package common\helpers\kriteria9
 */


namespace common\helpers\kriteria9;

use common\models\kriteria9\akreditasi\K9AkreditasiInstitusi;
use Yii;

class K9InstitusiDirectoryHelper extends K9DirectoryHelper
{
    public static function getPath()
    {
        return Yii::getAlias('@uploadInstitusi');
    }

    public static function getUrl()
    {
        return Yii::getAlias('@.uploadInstitusi');
    }

    public static function getDetailLedPath($akreditasi)
    {
        $path = Yii::getAlias('@uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/led";

        return $realPath;
    }

    private static function getK9InstitusiPath(K9AkreditasiInstitusi $akreditasiInstitusi)
    {
        $pathData = Yii::$app->params['uploadPath'];
        $pathReplacements = [
            '{lembaga}' => $akreditasiInstitusi->akreditasi->lembaga,
            '{jenis_akreditasi}' => $akreditasiInstitusi->akreditasi->jenis_akreditasi,
            '{tahun}' => $akreditasiInstitusi->akreditasi->tahun,
            '{level}' => 'institusi',
            '{id}' => ''
        ];
        return strtr($pathData, $pathReplacements);
    }

    public static function getDetailLedUrl($akreditasi)
    {
        $path = Yii::getAlias('@.uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/led";

        return $realPath;
    }

    public static function getDetailLkPath($akreditasi)
    {
        $path = Yii::getAlias('@uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/lk";

        return $realPath;
    }

    public static function getDetailLkUrl($akreditasi)
    {
        $path = Yii::getAlias('@.uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/lk";

        return $realPath;
    }

    public static function getDokumenLedPath($akreditasi)
    {

        $path = Yii::getAlias('@uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/led";

        return $realPath;
    }

    public static function getDokumenLedUrl($akreditasi)
    {
        $path = Yii::getAlias('@.uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/led";

        return $realPath;
    }

    public static function getDokumenLkPath($akreditasi)
    {
        $path = Yii::getAlias('@uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/lk";

        return $realPath;
    }

    public static function getDokumenLkUrl($akreditasi)
    {
        $path = Yii::getAlias('@.uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/lk";

        return $realPath;
    }

    public static function getKuantitatifPath($akreditasi)
    {
        $path = Yii::getAlias('@uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/matriks-kuantitatif";

        return $realPath;
    }

    public static function getKuantitatifUrl($akreditasi)
    {
        $path = Yii::getAlias('@.uploadAkreditasi');
        $documentPath = self::getK9InstitusiPath($akreditasi);
        $realPath = "$path/$documentPath/matriks-kuantitatif";

        return $realPath;
    }


    public static function getTemplateLkPath()
    {
        $path = Yii::getAlias('@required');
        $pathReplacement = [
            '{borang}' => 'kriteria9',
            '{jenis_dokumen}' => 'apt',
            '{template}' => 'template',
            '{untuk}' => 'lk'
        ];
        $templatePath = parent::getTemplateLk($pathReplacement);
        return "$path/$templatePath";
    }

    public static function getKuantitatifTemplate($jenis)
    {
        if ($jenis === 'akademik') {
            return Yii::getAlias('@required/kriteria9/apt/template/kuantitatif_akademik.xlsx');
        }

        return Yii::getAlias('@required/kriteria9/apt/template/kuantitatif_vokasi.xlsx');

    }

    public static function getLedPartialTemplate()
    {
        return Yii::getAlias('@required/kriteria9/apt/template/template-led-institusi-partial.docx');
    }

    public static function getLedCompleteTemplate()
    {
        return Yii::getAlias('@required/kriteria9/apt/template/template-led-institusi-complete.docx');
    }

    public static function getStrukturPath()
    {
        return Yii::getAlias('@akreditasi/web/upload/struktur/institusi');
    }

    public static function getStrukturUrl()
    {
        return Yii::getAlias('@.akreditasi/upload/struktur/institusi');
    }
}
