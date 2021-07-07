<?php


namespace akreditasi\modules\asesor\controllers;

use akreditasi\models\kriteria9\forms\led\K9DetailLedInstitusiNonKriteriaLinkForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiLinkForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiNonKriteriaUploadForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiTeksForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiUploadForm;
use akreditasi\models\kriteria9\forms\lk\prodi\K9LinkLkProdiKriteriaDetailForm;
use akreditasi\models\kriteria9\forms\lk\prodi\K9LkProdiKriteriaDetailForm;
use akreditasi\models\kriteria9\forms\lk\prodi\K9TextLkProdiKriteriaDetailForm;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\ProgramStudi;
use Yii;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii2mod\collection\Collection;

class ProdiController extends BaseController
{
    public function actionArsip()
    {
        $model = new DynamicModel(['akreditasi', 'prodi']);
        $model->addRule(['akreditasi', 'prodi'], 'required')
            ->addRule(['akreditasi'], 'integer')
            ->addRule(['prodi'], 'integer');

        $prodis = ProgramStudi::find()->all();
        $dataProdi = ArrayHelper::map($prodis, 'id', function ($prodi) {
            return $prodi->nama . ' (' . $prodi->jenjang . ')';
        });

        $dataAkreditasi = ArrayHelper::map(
            K9Akreditasi::findAll(['jenis_akreditasi' => K9Akreditasi::JENIS_PRODI]),
            'id',
            function ($akreditasi) {
                return $akreditasi->lembaga . ' (' . $akreditasi->tahun . ')';
            }
        );
        if ($model->load(Yii::$app->request->post())) {
            $akreditasiProdi = K9AkreditasiProdi::findOne([
                'id_akreditasi' => $model->akreditasi,
                'id_prodi' => $model->prodi
            ]);
            if (!$akreditasiProdi) {
                throw new NotFoundHttpException('Data yang anda cari tidak ditemukan.');
            }
            return $this->redirect(['prodi/index', 'id' => $akreditasiProdi->id]);
        }

        return $this->render('arsip',
            ['model' => $model, 'dataProdi' => $dataProdi, 'dataAkreditasi' => $dataAkreditasi]);
    }

    public function actionIndex($id)
    {
        $akreditasiProdi = $this->findAkreditasiProdi($id);
        $prodi = $akreditasiProdi->prodi;
        $jsonEksternal = K9ProdiJsonHelper::getJsonPenilaianKondisiEksternal($prodi->jenjang);
        $jsonProfil = K9ProdiJsonHelper::getJsonPenilaianProfil($prodi->jenjang);
        $jsonKriteria = K9ProdiJsonHelper::getJsonPenilaianKriteria($prodi->jenjang);
        $jsonAnalisis = K9ProdiJsonHelper::getJsonPenilaianAnalisis($prodi->jenjang);

        $modelEksternal = $akreditasiProdi->penilaianEksternal;
        $modelProfil = $akreditasiProdi->penilaianProfil;
        $modelKriteria = $akreditasiProdi->penilaianKriteria;
        $modelAnalisis = $akreditasiProdi->penilaianAnalisis;

        if ($modelEksternal->load(Yii::$app->request->post())) {
            $modelEksternal->save();
            Yii::$app->session->setFlash('success', 'Berhasil mengisi penilaian Kondisi Eksternal');
        }
        if ($modelProfil->load(Yii::$app->request->post())) {
            $modelProfil->save();
            Yii::$app->session->setFlash('success', 'Berhasil mengisi penilaian Profil UPPS');
        }
        if ($modelKriteria->load(Yii::$app->request->post())) {
            $modelKriteria->save();
            Yii::$app->session->setFlash('success', 'Berhasil mengisi penilaian Kriteria');
        }
        if ($modelAnalisis->load(Yii::$app->request->post())) {
            $modelAnalisis->save();
            Yii::$app->session->setFlash('success', 'Berhasil mengisi penilaian Analisis');
        }
        return $this->render(
            'index',
            compact(
                'akreditasiProdi',
                'prodi',
                'jsonEksternal',
                'jsonProfil',
                'jsonKriteria',
                'jsonAnalisis',
                'modelEksternal',
                'modelProfil',
                'modelKriteria',
                'modelAnalisis'
            )
        );
    }

    /**
     * @param $id
     * @return K9AkreditasiProdi|null
     * @throws NotFoundHttpException
     */
    protected function findAkreditasiProdi($id)
    {
        if ($model = K9AkreditasiProdi::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException();
    }

    public function actionLihatLk($akreditasi, $tabel)
    {
        if (Yii::$app->request->isAjax) {
            $akreditasiProdi = $this->findAkreditasiProdi($akreditasi);
            $programStudi = $akreditasiProdi->prodi;
            $kriteria = $tabel[0];
            $lk = $akreditasiProdi->k9LkProdi;
            $json = K9ProdiJsonHelper::getJsonKriteriaLk($kriteria, $programStudi->jenjang);
            $collection = Collection::make($json->butir);
            $current = $collection->where('tabel', $tabel)->first();
            $path = K9ProdiDirectoryHelper::getDokumenLkUrl($akreditasiProdi);
            $lkProdiKriteriaClass = 'common\\models\\kriteria9\lk\\prodi\\K9LkProdiKriteria' . $kriteria;
            $lkProdiKriteria = call_user_func($lkProdiKriteriaClass . '::findOne', ['id_lk_prodi' => $lk->id]);
            $detailAttr = 'k9LkProdiKriteria' . $kriteria . 'Details';
            $detail = $lkProdiKriteria->$detailAttr;
            $lkCollection = Collection::make($detail);
            $modelNarasiClass = 'akreditasi\\models\\kriteria9\\lk\\prodi\\K9LkProdiNarasiKriteria' . $kriteria . 'Form';
            $modelNarasi = call_user_func(
                $modelNarasiClass . '::findOne',
                ['id_lk_prodi_kriteria' . $kriteria => $lkProdiKriteria->id]
            );

            $dokUploadModel = new K9LkProdiKriteriaDetailForm();
            $dokTextModel = new K9TextLkProdiKriteriaDetailForm();
            $dokLinkModel = new K9LinkLkProdiKriteriaDetailForm();

            return $this->renderAjax('@akreditasi/modules/kriteria9/modules/prodi/views/lk/_item_lk', [
                'lkProdi' => $lk,
                'prodi' => $programStudi,
                'item' => $current,
                'path' => $path,
                'modelKriteria' => $lkProdiKriteria,
                'modelNarasi' => $modelNarasi,
                'dokUploadModel' => $dokUploadModel,
                'dokTextModel' => $dokTextModel,
                'dokLinkModel' => $dokLinkModel,
                'modelAttribute' => NomorKriteriaHelper::changeToDbFormat($tabel),
                'kriteria' => $kriteria,
                'poin' => $tabel,
                'lkCollection' => $lkCollection,
                'untuk' => 'lihat'
            ]);
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionLihatLed($akreditasi, $nomorLed)
    {
        if (Yii::$app->request->isAjax) {
            $akreditasiProdi = $this->findAkreditasiProdi($akreditasi);
            $led = $akreditasiProdi->k9LedProdi;
            $programStudi = $akreditasiProdi->prodi;
            $kriteria = $nomorLed[0];
            $nomor = substr($nomorLed, 0, 3);
            $attr = 'k9LedProdiKriteria' . $kriteria . 's';
            $currentLed = $led->$attr;
            $narasiAttr = 'k9LedProdiNarasiKriteria' . $kriteria . 's';
            $detailAttr = 'k9LedProdiKriteria' . $kriteria . 'Details';
            $narasi = $currentLed->$narasiAttr;
            $detail = $currentLed->$detailAttr;
            $detailCollection = Collection::make($detail);

            $detailModel = new K9DetailLedProdiUploadForm();
            $textModel = new K9DetailLedProdiTeksForm();
            $linkModel = new K9DetailLedProdiLinkForm();

            $realPath = K9ProdiDirectoryHelper::getDetailLedUrl($led->akreditasiProdi);

            $json = K9ProdiJsonHelper::getJsonKriteriaLed($kriteria);
            $kriteriaCollection = new Collection($json->butir);
            $currentPoint = $kriteriaCollection->where('nomor', $nomor)->first();

            return $this->renderAjax('@akreditasi/modules/kriteria9/modules/prodi/views/led/_isi_led', [
                'untuk' => 'lihat',
                'modelNarasi' => $narasi,
                'detailModel' => $detailModel,
                'textModel' => $textModel,
                'linkModel' => $linkModel,
                'model' => $led,
                'path' => $realPath,
                'detailCollection' => $detailCollection,
                'modelAttribute' => NomorKriteriaHelper::changeToDbFormat($nomor),
                'item' => $currentPoint,
                'kriteria' => $kriteria,
                'prodi' => $programStudi,
                'poin' => $nomorLed

            ]);
        }

        throw new MethodNotAllowedHttpException();
    }

    public function actionLihatLedNonKriteria($akreditasi, $nomorLed, $poin)
    {
        if (Yii::$app->request->isAjax) {
            $akreditasiProdi = $this->findAkreditasiProdi($akreditasi);
            $ledProdi = $akreditasiProdi->k9LedProdi;
            $programStudi = $akreditasiProdi->prodi;
            switch ($poin) {
                case 'A':
                    $modelNarasi = $ledProdi->narasiEksternal;
                    $json = K9ProdiJsonHelper::getJsonLedKondisiEksternal();
                    $currentPoint = $json;

                    break;
                case 'B':
                    $modelNarasi = $ledProdi->narasiProfil;
                    $json = K9ProdiJsonHelper::getJsonLedProfil();
                    $currentPoint = $json->butir;
                    break;
                case 'D':
                    $modelNarasi = $ledProdi->narasiAnalisis;
                    $json = K9ProdiJsonHelper::getJsonLedAnalisis();
                    $currentCollection = Collection::make($json->butir);
                    $currentPoint = $currentCollection->where('nomor', $nomorLed)->first();
                    break;
            }
            $detailNarasi = $modelNarasi->documents;
            $detailCollection = Collection::make($detailNarasi);

            $linkModel = new K9DetailLedInstitusiNonKriteriaLinkForm();
            $uploadModel = new K9DetailLedProdiNonKriteriaUploadForm();
            $textModel = new K9DetailLedProdiNonKriteriaUploadForm();
            $realPath = K9ProdiDirectoryHelper::getDetailLedUrl($ledProdi->akreditasiProdi);

            return $this->renderAjax('_isi_led_non_kriteria', [
                'modelNarasi' => $modelNarasi,
                'item' => $currentPoint,
                'linkModel' => $linkModel,
                'uploadModel' => $uploadModel,
                'textModel' => $textModel,
                'path' => $realPath,
                'prodi' => $programStudi,
                'detailCollection' => $detailCollection,
                'model' => $ledProdi,
                'poin' => $poin,
                'untuk' => 'lihat'
            ]);
        }

        throw new MethodNotAllowedHttpException();
    }

}
