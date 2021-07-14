<?php


namespace akreditasi\modules\api\controllers;


use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\forms\lk\K9PencarianLkProdiForm;
use common\models\kriteria9\lk\prodi\K9LkProdi;
use common\models\ProgramStudi;
use Yii;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii2mod\collection\Collection;

class LkProdiController extends BaseActiveController
{

    public $modelClass = K9LkProdi::class;

    public function actionArsip($target, $prodi)
    {

        $model = new K9PencarianLkProdiForm();

        $idAkreditasiProdi = K9Akreditasi::findAll(['jenis_akreditasi' => 'prodi']);
        $dataAkreditasiProdi = ArrayHelper::map($idAkreditasiProdi, 'id', function ($data) {
            return $data->lembaga . ' - ' . $data->nama . '(' . $data->tahun . ')';
        });

        $idProdi = ProgramStudi::findAll(['id' => $prodi]);
        $dataProdi = ArrayHelper::map($idProdi, 'id', function ($data) {
            return $data->nama . '(' . $data->jenjang . ')';
        });


        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                $url = $model->cari($target);
                $lk = $model->getLk();
                $newUrl = [];
                if (!$lk) {
                    $newUrl = false;
                } else {
                    $newUrl = [$url, 'lk' => $lk->id, 'prodi' => $prodi];
                }
                return ['lk' => $lk, 'url' => $newUrl];
            }
        }
        return [
            'model' => $model,
            'dataAkreditasiProdi' => $dataAkreditasiProdi,
            'dataProdi' => $dataProdi
        ];
    }
    public function actionLihatKriteria($lk, $kriteria)
    {

        $lkProdi = $this->findLkProdi($lk);

        $programStudi = $lkProdi->akreditasiProdi->prodi;
        $json = K9ProdiJsonHelper::getJsonKriteriaLk($kriteria, $programStudi->jenjang);

        $poinKriteria = $json->butir;

        $path = K9ProdiDirectoryHelper::getDokumenLkUrl($lkProdi->akreditasiProdi);
        $attrKriteria = 'k9LkProdiKriteria' . $kriteria . 's';
        $lkProdiKriteria = $lkProdi->$attrKriteria;


        $modelNarasiClass = 'akreditasi\\models\\kriteria9\\lk\\prodi\\K9LkProdiNarasiKriteria' . $kriteria . 'Form';
        $modelNarasi = call_user_func($modelNarasiClass . '::findOne',
            ['id_lk_prodi_kriteria' . $kriteria => $lkProdiKriteria->id]);

        return [
            'poinKriteria' => $poinKriteria,
            'path' => $path,
            'lkProdiKriteria' => $lkProdiKriteria,
            'modelNarasi' => $modelNarasi
        ];
    }

    protected function findLkProdi($id)
    {
        $model = null;
        if ($model = K9LkProdi::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }

    public function actionButirItem($lk, $kriteria, $poin)
    {
        $lkProdi = $this->findLkProdi($lk);
        $programStudi = $lkProdi->akreditasiProdi->prodi;
        //json
        $currentPoint = $this->getKriteriaNomor($kriteria, $poin, $programStudi->jenjang);

        $path = K9ProdiDirectoryHelper::getDokumenLkUrl($lkProdi->akreditasiProdi);
        $lkProdiKriteriaClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria;
        $lkProdiKriteria = call_user_func($lkProdiKriteriaClass . '::findOne', ['id_lk_prodi' => $lkProdi->id]);
        $detailAttr = 'k9LkProdiKriteria' . $kriteria . 'Details';
        $detail = $lkProdiKriteria->$detailAttr;
        $lkCollection = Collection::make($detail);
        $modelNarasiClass = 'akreditasi\\models\\kriteria9\\lk\\prodi\\K9LkProdiNarasiKriteria' . $kriteria . 'Form';
        $modelNarasi = call_user_func($modelNarasiClass . '::findOne',
            ['id_lk_prodi_kriteria' . $kriteria => $lkProdiKriteria->id]);

        $dokUploadModel = null;
        $dokTextModel = null;
        $dokLinkModel = null;

        return [
            'lkProdi' => $lkProdi,
            'prodi' => $programStudi,
            'item' => $currentPoint,
            'path' => $path,
            'modelKriteria' => $lkProdiKriteria,
            'modelNarasi' => $modelNarasi,
            'dokUploadModel' => $dokUploadModel,
            'dokTextModel' => $dokTextModel,
            'dokLinkModel' => $dokLinkModel,
            'modelAttribute' => NomorKriteriaHelper::changeToDbFormat($poin),
            'kriteria' => $kriteria,
            'poin' => $poin,
            'lkCollection' => $lkCollection,
            'untuk' => 'lihat'
        ];
    }

    protected function getKriteriaNomor($kriteria, $item, $jenis)
    {
        $data = K9ProdiJsonHelper::getJsonKriteriaLk($kriteria, $jenis);
        return Collection::make($data->butir)->where('tabel', $item)->first();
    }

    public function actionDownloadDetail($dokumen, $kriteria, $lk, $prodi, $jenis)
    {
        ini_set('max_execution_time', 5 * 60);

        $detailClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria . 'Detail';

        $model = call_user_func($detailClass . '::findOne', $dokumen);
        $attribute = 'lkProdiKriteria' . $kriteria;

        $path = K9ProdiDirectoryHelper::getDokumenLkPath($model->$attribute->lkProdi->akreditasiProdi);
        $file = $model->isi_dokumen;

        $path = $this->download($model, $path, $file);


        return Yii::$app->response->sendFile($path);
    }

    public function actionLihatDokumen($id, $kriteria)
    {

        $modelClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria . 'Detail';
        $relationAttr = 'lkProdiKriteria' . $kriteria;
        $model = call_user_func($modelClass . '::findOne', $id);

        $path = K9ProdiDirectoryHelper::getDetailLedUrl($model->$relationAttr->lkProdi->akreditasiProdi) . '/'
            . $model->jenis_dokumen;

        if (Yii::$app->request->isAjax) {

            return [
                'path' => $path,
                'model' => $model
            ];
        }

        throw new MethodNotAllowedHttpException();
    }
}
