<?php


namespace akreditasi\modules\api\controllers;


use akreditasi\models\kriteria9\led\prodi\K9LedProdiNarasiAnalisisForm;
use akreditasi\models\kriteria9\led\prodi\K9LedProdiNarasiKondisiEksternalForm;
use akreditasi\models\kriteria9\led\prodi\K9LedProdiNarasiProfilUppsForm;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\models\Constants;
use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\forms\led\K9PencarianLedProdiForm;
use common\models\kriteria9\led\prodi\K9LedProdi;
use common\models\kriteria9\led\prodi\K9LedProdiNonKriteriaDokumen;
use common\models\kriteria9\led\prodi\K9ProdiEksporDokumen;
use common\models\ProgramStudi;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii2mod\collection\Collection;

class LedProdiController extends BaseActiveController
{

    public $modelClass = K9LedProdi::class;

    public function actionArsip($target, $prodi)
    {

        $model = new K9PencarianLedProdiForm();
        $akreditasi = K9Akreditasi::findAll(['jenis_akreditasi' => Constants::PRODI]);
        $progdi = ProgramStudi::findAll(['id' => $prodi]);
        $dataProdi = ArrayHelper::map($progdi, 'id', 'nama');
        $dataAkreditasi = ArrayHelper::map($akreditasi, 'id', function ($data) {
            return $data->lembaga . ' - ' . $data->nama . " (" . $data->tahun . ")";
        });

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                $url = $model->cari($target);
                $led = $model->getLed();
                $newUrl = [];
                if (!$led) {
                    $newUrl = false;
                } else {
                    $newUrl = $url;
                }

                return ['led' => $led, 'url' => $newUrl];
            }
        }
        return [
            'model' => $model,
            'dataAkreditasi' => $dataAkreditasi,
            'dataProdi' => $dataProdi
        ];
    }

    public function actionButirItem($led, $kriteria, $poin)
    {

        $ledProdi = K9LedProdi::findOne(['id' => $led]);
        $attr = 'k9LedProdiKriteria' . $kriteria . 's';
        $modelLed = $ledProdi->$attr;
        $prodi = $ledProdi->akreditasiProdi->prodi;
        $detailAttr = 'k9LedProdiKriteria' . $kriteria . 'Details';
        $detail = $modelLed->$detailAttr;

        $detailCollection = Collection::make($detail);

        $json = K9ProdiJsonHelper::getJsonKriteriaLed($kriteria);
        $kriteriaCollection = new Collection($json->butir);
        $currentPoint = $kriteriaCollection->where('nomor', $poin)->first();

        $modelNarasiClass = 'akreditasi\\models\\kriteria9\\led\\prodi\\K9LedProdiNarasiKriteria' . $kriteria . 'Form';
        $modelNarasi = call_user_func($modelNarasiClass . '::findOne',
            ['id_led_prodi_kriteria' . $kriteria => $modelLed->id]);


        $detailModel = null;
        $textModel = null;
        $linkModel = null;


        $realPath = K9ProdiDirectoryHelper::getDetailLedUrl($modelLed->ledProdi->akreditasiProdi);

        return [
            'model' => $modelLed,
            'modelNarasi' => $modelNarasi,
            'detailModel' => $detailModel,
            'path' => $realPath,
            'textModel' => $textModel,
            'linkModel' => $linkModel,
            'detailCollection' => $detailCollection,
            'modelAttribute' => NomorKriteriaHelper::changeToDbFormat($poin),
            'item' => $currentPoint,
            'kriteria' => $kriteria,
            'prodi' => $prodi,
            'untuk' => 'lihat',
            'poin' => $poin
        ];
    }

    public function actionButirItemNonKriteria($led, $poin, $nomor)
    {

        $ledProdi = K9LedProdi::findOne($led);

        switch ($poin) {
            case 'A':
                $json = K9ProdiJsonHelper::getJsonLedKondisiEksternal();
                $modelNarasi = K9LedProdiNarasiKondisiEksternalForm::findOne(['id_led_prodi' => $ledProdi->id]);

                break;
            case 'B':
                $json = K9ProdiJsonHelper::getJsonLedProfil();
                $modelNarasi = K9LedProdiNarasiProfilUppsForm::findOne(['id_led_prodi' => $ledProdi->id]);;

                break;
            case 'D':
                $json = K9ProdiJsonHelper::getJsonLedAnalisis();
                $modelNarasi = K9LedProdiNarasiAnalisisForm::findOne(['id_led_prodi' => $ledProdi->id]);

                break;
        }


        $detailNarasi = $modelNarasi->documents;
        $detailCollection = Collection::make($detailNarasi);
        $modelAttribute = NomorKriteriaHelper::changeToDbFormat($nomor);
        $currentPoint = $json;
        if ($json->butir) {
            $currentCollection = Collection::make($json->butir);
            $currentPoint = $currentCollection->where('nomor', $nomor)->first();
        }

        $linkModel = null;
        $uploadModel = null;
        $textModel = null;
        $realPath = K9ProdiDirectoryHelper::getDetailLedUrl($ledProdi->akreditasiProdi);

        return [

            'modelNarasi' => $modelNarasi,
            'item' => $currentPoint,
            'linkModel' => $linkModel,
            'uploadModel' => $uploadModel,
            'textModel' => $textModel,
            'path' => $realPath,
            'modelAttribute' => $modelAttribute,
            'prodi' => $ledProdi->akreditasiProdi->prodi,
            'detailCollection' => $detailCollection,
            'model' => $ledProdi,
            'poin' => $poin,
            'untuk' => 'lihat'
        ];
    }

    public function actionLihatKriteria($led, $kriteria)
    {

        $ledProdi = K9LedProdi::findOne(['id' => $led]);
        $akreditasiProdi = $ledProdi->akreditasiProdi;
        $programStudi = $akreditasiProdi->prodi;
        $attr = 'k9LedProdiKriteria' . $kriteria . 's';
        $modelLed = $ledProdi->$attr;

        $json = K9ProdiJsonHelper::getJsonKriteriaLed($kriteria);
        $poinKriteria = $json->butir;
        return [
            'model' => $modelLed,
            'poinKriteria' => $poinKriteria,
            'untuk' => 'lihat',
            'kriteria' => $kriteria,
            'prodi' => $programStudi,
            'akreditasiProdi' => $akreditasiProdi,
            'akreditasi'=>$akreditasiProdi->akreditasi
        ];
    }

    public function actionLihatNonKriteria($led, $poin)
    {
        $ledProdi = K9LedProdi::findOne($led);
        $akreditasiProdi = $ledProdi->akreditasiProdi;
        $programStudi = $akreditasiProdi->prodi;

        switch ($poin) {
            case 'A':
                $modelNarasi = $ledProdi->narasiEksternal;
                $json = K9ProdiJsonHelper::getJsonLedKondisiEksternal();
                break;
            case 'B':
                $modelNarasi = $ledProdi->narasiProfil;
                $json = K9ProdiJsonHelper::getJsonLedProfil();
                break;
            case 'D':
                $modelNarasi = $ledProdi->narasiAnalisis;
                $json = K9ProdiJsonHelper::getJsonLedAnalisis();
                break;
        }

        $currentPoint = $json->butir;


        $detail = $modelNarasi->documents;


        $untuk = 'lihat';

        return
            [
                'ledProdi' => $ledProdi,
                'json' => $json,
                'poin' => $poin,
                'modelNarasi' => $modelNarasi,
                'detail' => $detail,
                'untuk' => $untuk,
                'prodi' => $programStudi,
                'akreditasiProdi' => $akreditasiProdi,
                'currentPoint' => $currentPoint,
                'akreditasi'=>$akreditasiProdi->akreditasi

            ];
    }

    public function actionDownloadDetail($kriteria, $dokumen, $led, $jenis)
    {
        $led = K9LedProdi::findOne($led);
        $namespace = 'common\\models\\kriteria9\\led\\prodi';
        $className = "$namespace\\K9LedProdiKriteria$kriteria" . 'Detail';
        $model = call_user_func($className . '::findOne', $dokumen);
        $file = K9ProdiDirectoryHelper::getDokumenLedUrl($led->akreditasiProdi) . "/$jenis/{$model->isi_dokumen}";
        return ['path'=>$file,'filename'=>$model->isi_dokumen];
    }

    public function actionDownloadDetailNonKriteria($poin, $dokumen, $led, $jenis)
    {
        $led = K9LedProdi::findOne($led);
        $model = K9LedProdiNonKriteriaDokumen::findOne($dokumen);
        $file = K9ProdiDirectoryHelper::getDokumenLedUrl($led->akreditasiProdi) . "/$jenis/{$model->isi_dokumen}";
        return ['path'=>$file,'filename'=>$model->isi_dokumen];
    }

    public function actionLihatDokumen($id, $kriteria)
    {

        $modelClass = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiKriteria' . $kriteria . 'Detail';
        $relationAttr = 'ledProdiKriteria' . $kriteria;
        $model = call_user_func($modelClass . '::findOne', $id);

        $path = K9ProdiDirectoryHelper::getDetailLedUrl($model->$relationAttr->ledProdi->akreditasiProdi) . '/'
            . $model->jenis_dokumen;



            return compact
            ('path', 'model');
    }

    public function actionLihatDokumenNonKriteria($id)
    {

        $model = K9LedProdiNonKriteriaDokumen::findOne($id);

        $path = K9ProdiDirectoryHelper::getDetailLedUrl($model->ledProdi->akreditasiProdi) . '/'
            . $model->jenis_dokumen;


            return
                compact
                ('path', 'model');


    }


    public function actionDownloadDokumen($dokumen)
    {
        $model = K9ProdiEksporDokumen::findOne($dokumen);
        $file = K9ProdiDirectoryHelper::getDokumenLedUrl($model->ledProdi->akreditasiProdi) . "/{$model->nama_dokumen}";
        return ["path"=>$file, 'filename'=>$model->nama_dokumen];
    }

    /**
     * @param $led
     * @return K9LedProdi|null
     * @throws NotFoundHttpException
     */
    protected function findLedProdi($led)
    {
        $model = null;
        if ($model = K9LedProdi::findOne($led)) {
            return $model;
        }

        throw new NotFoundHttpException();
    }
}
