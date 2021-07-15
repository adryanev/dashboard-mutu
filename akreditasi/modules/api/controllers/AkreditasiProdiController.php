<?php


namespace akreditasi\modules\api\controllers;


use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\kriteria9\led\prodi\K9LedProdiKriteria1;
use common\models\kriteria9\led\prodi\K9LedProdiKriteria2;
use common\models\kriteria9\led\prodi\K9LedProdiKriteria3;
use common\models\kriteria9\led\prodi\K9LedProdiKriteria4;
use common\models\kriteria9\led\prodi\K9LedProdiKriteria5;
use common\models\kriteria9\led\prodi\K9LedProdiKriteria6;
use common\models\kriteria9\led\prodi\K9LedProdiKriteria7;
use common\models\kriteria9\led\prodi\K9LedProdiKriteria8;
use common\models\kriteria9\led\prodi\K9LedProdiKriteria9;
use common\models\kriteria9\led\prodi\K9ProdiEksporDokumen;
use common\models\kriteria9\lk\prodi\K9LkProdiKriteria1;
use common\models\kriteria9\lk\prodi\K9LkProdiKriteria2;
use common\models\kriteria9\lk\prodi\K9LkProdiKriteria3;
use common\models\kriteria9\lk\prodi\K9LkProdiKriteria4;
use common\models\kriteria9\lk\prodi\K9LkProdiKriteria5;
use common\models\kriteria9\lk\prodi\K9LkProdiKriteria6;
use common\models\kriteria9\lk\prodi\K9LkProdiKriteria7;
use common\models\kriteria9\lk\prodi\K9LkProdiKriteria8;
use common\models\ProgramStudi;
use Yii;
use yii\web\NotFoundHttpException;

class AkreditasiProdiController extends BaseActiveController
{

    public $modelClass = K9AkreditasiProdi::class;

    public function actionDetail($id)
    {

        $akreditasiProdi = K9AkreditasiProdi::findOne(['id' => $id]);
        $modelProdi = $akreditasiProdi->prodi;
        //led
        $jsonLed = K9ProdiJsonHelper::getAllJsonLed();
        $json_kriteria = K9ProdiJsonHelper::getAllJsonLed();
        $json_eksternal = K9ProdiJsonHelper::getJsonLedKondisiEksternal();
        $json_profil = K9ProdiJsonHelper::getJsonLedProfil();
        $json_analisis = K9ProdiJsonHelper::getJsonLedAnalisis();
        $ledProdi = $akreditasiProdi->k9LedProdi;
        $dokumenLed = $ledProdi->getEksporDokumen()->orderBy('kode_dokumen')->all();
        $kriteriaLed = $this->getArrayKriteraLed($ledProdi->id);
        $urlLed = K9ProdiDirectoryHelper::getDokumenLedUrl($ledProdi->akreditasiProdi);
        $modelEksternal = $ledProdi->narasiEksternal;
        $modelProfil = $ledProdi->narasiProfil;
        $modelAnalisis = $ledProdi->narasiAnalisis;


        //lk
        $jsonLk = K9ProdiJsonHelper::getAllJsonLk($modelProdi->jenjang);
        $lkProdi = $akreditasiProdi->k9LkProdi;
        $kriteriaLk = $this->getArrayKriteriaLk($lkProdi->id);

        $dataDokumen = $lkProdi->eksporDokumen;
        return  [
            'modelProdi' => $modelProdi,
            'akreditasiProdi' => $akreditasiProdi,
            'jsonLed' => $jsonLed,
            'ledProdi' => $ledProdi,
            'dokumenLed' => $dokumenLed,
            'kriteriaLed' => $kriteriaLed,
            'urlLed' => $urlLed,
            'jsonLk' => $jsonLk,
            'lkProdi' => $lkProdi,
            'kriteriaLk' => $kriteriaLk,
            'json' => $json_kriteria,
            'json_eksternal' => $json_eksternal,
            'json_profil' => $json_profil,
            'json_analisis' => $json_analisis,
            'modelEksternal' => $modelEksternal,
            'modelAnalisis' => $modelAnalisis,
            'modelProfil' => $modelProfil,
            'dataDokumen' => $dataDokumen,
            'path' => K9ProdiDirectoryHelper::getDokumenLkUrl($akreditasiProdi)
        ];
    }

    protected function findProdi($id)
    {
        $model = ProgramStudi::findOne($id);
        if ($model) {
            return $model;
        }
        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }

    protected function getArrayKriteraLed($led)
    {
        $kriteria1 = K9LedProdiKriteria1::findOne(['id_led_prodi' => $led]);
        $kriteria2 = K9LedProdiKriteria2::findOne(['id_led_prodi' => $led]);
        $kriteria3 = K9LedProdiKriteria3::findOne(['id_led_prodi' => $led]);
        $kriteria4 = K9LedProdiKriteria4::findOne(['id_led_prodi' => $led]);
        $kriteria5 = K9LedProdiKriteria5::findOne(['id_led_prodi' => $led]);
        $kriteria6 = K9LedProdiKriteria6::findOne(['id_led_prodi' => $led]);
        $kriteria7 = K9LedProdiKriteria7::findOne(['id_led_prodi' => $led]);
        $kriteria8 = K9LedProdiKriteria8::findOne(['id_led_prodi' => $led]);
        $kriteria9 = K9LedProdiKriteria9::findOne(['id_led_prodi' => $led]);

        return [
            $kriteria1,
            $kriteria2,
            $kriteria3,
            $kriteria4,
            $kriteria5,
            $kriteria6,
            $kriteria7,
            $kriteria8,
            $kriteria9
        ];
    }
    protected function getArrayKriteriaLk($lk)
    {
        $kriteria1 = K9LkProdiKriteria1::find()->with('lkProdi')->where(['id_lk_prodi' => $lk])->one();
        $kriteria2 = K9LkProdiKriteria2::find()->with('lkProdi')->where(['id_lk_prodi' => $lk])->one();
        $kriteria3 = K9LkProdiKriteria3::find()->with('lkProdi')->where(['id_lk_prodi' => $lk])->one();
        $kriteria4 = K9LkProdiKriteria4::find()->with('lkProdi')->where(['id_lk_prodi' => $lk])->one();
        $kriteria5 = K9LkProdiKriteria5::find()->with('lkProdi')->where(['id_lk_prodi' => $lk])->one();
        $kriteria6 = K9LkProdiKriteria6::find()->with('lkProdi')->where(['id_lk_prodi' => $lk])->one();
        $kriteria7 = K9LkProdiKriteria7::find()->with('lkProdi')->where(['id_lk_prodi' => $lk])->one();
        $kriteria8 = K9LkProdiKriteria8::find()->with('lkProdi')->where(['id_lk_prodi' => $lk])->one();

        return [$kriteria1, $kriteria2, $kriteria3, $kriteria4, $kriteria5, $kriteria6, $kriteria7, $kriteria8];
    }
}
