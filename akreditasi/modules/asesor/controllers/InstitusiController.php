<?php


namespace akreditasi\modules\asesor\controllers;


use akreditasi\models\kriteria9\forms\led\K9DetailLedInstitusiLinkForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedInstitusiNonKriteriaLinkForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedInstitusiNonKriteriaUploadForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedInstitusiTeksForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedInstitusiUploadForm;
use akreditasi\models\kriteria9\forms\lk\institusi\K9LinkLkInstitusiKriteriaDetailForm;
use akreditasi\models\kriteria9\forms\lk\institusi\K9LkInstitusiKriteriaDetailForm;
use akreditasi\models\kriteria9\forms\lk\institusi\K9TextLkInstitusiKriteriaDetailForm;
use common\helpers\kriteria9\K9InstitusiDirectoryHelper;
use common\helpers\kriteria9\K9InstitusiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\akreditasi\K9AkreditasiInstitusi;
use common\models\ProfilInstitusi;
use Yii;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii2mod\collection\Collection;

class InstitusiController extends BaseController
{

    public function actionArsip()
    {
        $model = new DynamicModel(['akreditasi']);
        $model->addRule(['akreditasi'], 'required')
            ->addRule(['akreditasi'], 'integer');

        $dataAkreditasi = ArrayHelper::map(K9Akreditasi::findAll(['jenis_akreditasi' => K9Akreditasi::JENIS_INSTITUSI]),
            'id', function ($akreditasi) {
                return $akreditasi->lembaga . '(' . $akreditasi->tahun . ')';
            });

        if ($model->load(Yii::$app->request->post())) {
            $akreditasiInstitusi = K9AkreditasiInstitusi::findOne(['id_akreditasi' => $model->akreditasi]);
            if (!$akreditasiInstitusi) {
                throw new NotFoundHttpException();
            }

            return $this->redirect(['institusi/index', 'id' => $akreditasiInstitusi->id]);
        }
        return $this->render('arsip',
            ['model' => $model, 'dataAkreditasi' => $dataAkreditasi]);

    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionIndex($id)
    {
        $akreditasiInstitusi = $this->findAkreditasiInstitusi($id);
        $profil = ArrayHelper::map(ProfilInstitusi::find()->all(), 'nama', 'isi');
        $jsonEksternal = K9InstitusiJsonHelper::getJsonPenilaianKondisiEksternal($profil['jenis_pengelolaan']);
        $jsonProfil = K9InstitusiJsonHelper::getJsonPenilaianProfil($profil['jenis_pengelolaan']);
        $jsonKriteria = K9InstitusiJsonHelper::getJsonPenilaianKriteria($profil['jenis_pengelolaan']);
        $jsonAnalisis = K9InstitusiJsonHelper::getJsonPenilaianAnalisis($profil['jenis_pengelolaan']);

        $modelEksternal = $akreditasiInstitusi->penilaianEksternal;
        $modelProfil = $akreditasiInstitusi->penilaianProfil;
        $modelKriteria = $akreditasiInstitusi->penilaianKriteria;
        $modelAnalisis = $akreditasiInstitusi->penilaianAnalisis;

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
                'akreditasiInstitusi',
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
     * @return K9AkreditasiInstitusi|null
     * @throws NotFoundHttpException
     */
    protected function findAkreditasiInstitusi($id)
    {

        $model = null;
        if ($model = K9AkreditasiInstitusi::findOne($id)) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    public function actionLihatLk($akreditasi, $tabel)
    {
        if (Yii::$app->request->isAjax) {
            $akreditasiInstitusi = $this->findAkreditasiInstitusi($akreditasi);
            $kriteria = $tabel[0];
            $lk = $akreditasiInstitusi->k9LkInstitusi;
            $profilInstitusi = ArrayHelper::map(ProfilInstitusi::find()->all(), 'nama', 'isi');
            $json = K9InstitusiJsonHelper::getJsonKriteriaLk($kriteria, $profilInstitusi['bentuk']);
            $collection = Collection::make($json->butir);
            $current = $collection->where('tabel', $tabel)->first();
            $path = K9InstitusiDirectoryHelper::getDokumenLkUrl($akreditasiInstitusi);
            $lkInstitusiKriteriaClass = 'common\\models\\kriteria9\lk\\institusi\\K9LkInstitusiKriteria' . $kriteria;
            $lkInstitusiKriteria = call_user_func($lkInstitusiKriteriaClass . '::findOne',
                ['id_lk_institusi' => $lk->id]);
            $detailAttr = 'k9LkInstitusiKriteria' . $kriteria . 'Details';
            $detail = $lkInstitusiKriteria->$detailAttr;
            $lkCollection = Collection::make($detail);
            $modelNarasiClass = 'akreditasi\\models\\kriteria9\\lk\\institusi\\K9LkInstitusiNarasiKriteria' . $kriteria . 'Form';
            $modelNarasi = call_user_func(
                $modelNarasiClass . '::findOne',
                ['id_lk_institusi_kriteria' . $kriteria => $lkInstitusiKriteria->id]
            );

            $dokUploadModel = new K9LkInstitusiKriteriaDetailForm();
            $dokTextModel = new K9TextLkInstitusiKriteriaDetailForm();
            $dokLinkModel = new K9LinkLkInstitusiKriteriaDetailForm();

            return $this->renderAjax('@akreditasi/modules/kriteria9/modules/institusi/views/lk/_item_lk', [
                'lkInstitusi' => $lk,
                'item' => $current,
                'path' => $path,
                'modelKriteria' => $lkInstitusiKriteria,
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
            $akreditasiInstitusi = $this->findAkreditasiInstitusi($akreditasi);
            $led = $akreditasiInstitusi->k9LedInstitusi;
            $kriteria = $nomorLed[0];
            $nomor = substr($nomorLed, 0, 3);
            $attr = 'k9LedInstitusiKriteria' . $kriteria . 's';
            $currentLed = $led->$attr;
            $narasiAttr = 'k9LedInstitusiNarasiKriteria' . $kriteria . 's';
            $detailAttr = 'k9LedInstitusiKriteria' . $kriteria . 'Details';
            $narasi = $currentLed->$narasiAttr;
            $detail = $currentLed->$detailAttr;
            $detailCollection = Collection::make($detail);

            $detailModel = new K9DetailLedInstitusiUploadForm();
            $textModel = new K9DetailLedInstitusiTeksForm();
            $linkModel = new K9DetailLedInstitusiLinkForm();

            $realPath = K9InstitusiDirectoryHelper::getDetailLedUrl($led->akreditasiInstitusi);

            $json = K9InstitusiJsonHelper::getJsonKriteriaLed($kriteria);
            $kriteriaCollection = new Collection($json->butir);
            $currentPoint = $kriteriaCollection->where('nomor', $nomor)->first();

            return $this->renderAjax('@akreditasi/modules/kriteria9/modules/institusi/views/led/_isi_led', [
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
                'poin' => $nomorLed

            ]);
        }

        throw new MethodNotAllowedHttpException();
    }

    public function actionLihatLedNonKriteria($akreditasi, $nomorLed, $poin)
    {
        if (Yii::$app->request->isAjax) {
            $akreditasiInstitusi = $this->findAkreditasiInstitusi($akreditasi);
            $ledInstitusi = $akreditasiInstitusi->k9LedInstitusi;
            switch ($poin) {
                case 'A':
                    $modelNarasi = $ledInstitusi->narasiEksternal;
                    $json = K9InstitusiJsonHelper::getJsonLedKondisiEksternal();
                    $currentPoint = $json;

                    break;
                case 'B':
                    $modelNarasi = $ledInstitusi->narasiProfil;
                    $json = K9InstitusiJsonHelper::getJsonLedProfil();
                    $currentPoint = $json->butir;
                    break;
                case 'D':
                    $modelNarasi = $ledInstitusi->narasiAnalisis;
                    $json = K9InstitusiJsonHelper::getJsonLedAnalisis();
                    $currentCollection = Collection::make($json->butir);
                    $currentPoint = $currentCollection->where('nomor', $nomorLed)->first();
                    break;
            }
            $detailNarasi = $modelNarasi->documents;
            $detailCollection = Collection::make($detailNarasi);

            $linkModel = new K9DetailLedInstitusiNonKriteriaLinkForm();
            $uploadModel = new K9DetailLedInstitusiNonKriteriaUploadForm();
            $textModel = new K9DetailLedInstitusiNonKriteriaUploadForm();
            $realPath = K9InstitusiDirectoryHelper::getDetailLedUrl($ledInstitusi->akreditasiInstitusi);

            return $this->renderAjax('_isi_led_non_kriteria', [
                'modelNarasi' => $modelNarasi,
                'item' => $currentPoint,
                'linkModel' => $linkModel,
                'uploadModel' => $uploadModel,
                'textModel' => $textModel,
                'path' => $realPath,
                'detailCollection' => $detailCollection,
                'model' => $ledInstitusi,
                'poin' => $poin,
                'untuk' => 'lihat'
            ]);
        }

        throw new MethodNotAllowedHttpException();
    }

}
