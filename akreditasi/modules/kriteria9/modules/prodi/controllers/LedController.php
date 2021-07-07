<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 9/7/2019
 * Time: 12:36 AM
 */

namespace akreditasi\modules\kriteria9\modules\prodi\controllers;

use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiLinkForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiNonKriteriaLinkForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiNonKriteriaTeksForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiNonKriteriaUploadForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiTeksForm;
use akreditasi\models\kriteria9\forms\led\K9DetailLedProdiUploadForm;
use akreditasi\models\kriteria9\forms\led\K9DokumenLedProdiUploadForm;
use akreditasi\models\kriteria9\led\prodi\K9LedProdiNarasiAnalisisForm;
use akreditasi\models\kriteria9\led\prodi\K9LedProdiNarasiKondisiEksternalForm;
use akreditasi\models\kriteria9\led\prodi\K9LedProdiNarasiProfilUppsForm;
use akreditasi\modules\kriteria9\controllers\BaseController;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\jobs\LedProdiCompleteExportJob;
use common\jobs\LedProdiPartialExportJob;
use common\models\Constants;
use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\forms\led\K9PencarianLedProdiForm;
use common\models\kriteria9\led\prodi\K9LedProdi;
use common\models\kriteria9\led\prodi\K9LedProdiNarasiAnalisis;
use common\models\kriteria9\led\prodi\K9LedProdiNarasiKondisiEksternal;
use common\models\kriteria9\led\prodi\K9LedProdiNarasiProfilUpps;
use common\models\kriteria9\led\prodi\K9LedProdiNonKriteriaDokumen;
use common\models\kriteria9\led\prodi\K9ProdiEksporDokumen;
use common\models\ProgramStudi;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii2mod\collection\Collection;

class LedController extends BaseController
{

    protected $lihatLedView = '@akreditasi/modules/kriteria9/modules/prodi/views/led/led';
    protected $lihatKriteriaView = '@akreditasi/modules/kriteria9/modules/prodi/views/led/isi-kriteria';
    protected $lihatNonKriteriaView = '@akreditasi/modules/kriteria9/modules/prodi/views/led/isi-non_kriteria';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'export-partial-kriteria' => ['POST'],
                    'export-partial-non-kriteria' => ['POST'],
                    'export-complete' => ['POST']
                ]
            ]
        ];
    }

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

                return $this->renderAjax('_hasil-arsip', ['led' => $led, 'url' => $newUrl]);
            }
        }
        return $this->render('arsip', [
            'model' => $model,
            'dataAkreditasi' => $dataAkreditasi,
            'dataProdi' => $dataProdi
        ]);
    }

    public function actionHapusDokumenLed()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            $idDokumenLed = $data['id'];
            $prodi = $data['prodi'];
            $dokumenLedProdi = K9ProdiEksporDokumen::findOne($idDokumenLed);
            $path = K9ProdiDirectoryHelper::getDokumenLedPath($dokumenLedProdi->ledProdi->akreditasiProdi);
            $deleteDokumen = FileHelper::unlink($path . '/' . $dokumenLedProdi->nama_dokumen);
            if ($deleteDokumen) {
                $dokumenLedProdi->delete();
                Yii::$app->session->setFlash('success', 'Berhasil menghapus dokumen led');
                return $this->redirect(['led/isi', 'led' => $dokumenLedProdi->ledProdi->id, 'prodi' => $prodi]);
            }
            Yii::$app->session->setFlash('success', 'Gagal menghapus dokumen led');
            return $this->redirect(['led/isi', 'led' => $dokumenLedProdi->ledProdi->id, 'prodi' => $prodi]);
        }

        return new MethodNotAllowedHttpException('Harus melalui prosedur penghapusan data.');
    }

    public function actionDownloadDokumen($dokumen)
    {
        ini_set('max_execution_time', 5 * 60);
        $model = K9ProdiEksporDokumen::findOne($dokumen);
        $file = K9ProdiDirectoryHelper::getDokumenLedPath($model->ledProdi->akreditasiProdi) . "/{$model->nama_dokumen}";
        return Yii::$app->response->sendFile($file);
    }

    /**
     * @param $led
     * @param $prodi
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionIsi($led, $prodi)
    {
        $ledProdi = $this->findLedProdi($led);

        $programStudi = $ledProdi->akreditasiProdi->prodi;

        $json_kriteria = K9ProdiJsonHelper::getAllJsonLed();
        $json_eksternal = K9ProdiJsonHelper::getJsonLedKondisiEksternal();
        $json_profil = K9ProdiJsonHelper::getJsonLedProfil();
        $json_analisis = K9ProdiJsonHelper::getJsonLedAnalisis();

        $modelEksternal = K9LedProdiNarasiKondisiEksternalForm::findOne(['id_led_prodi' => $ledProdi->id]);
        $modelProfil = K9LedProdiNarasiProfilUppsForm::findOne(['id_led_prodi' => $ledProdi->id]);
        $modelAnalisis = K9LedProdiNarasiAnalisisForm::findOne(['id_led_prodi' => $ledProdi->id]);

        $modelDokumen = new K9DokumenLedProdiUploadForm();
        $dataDokumen = $ledProdi->getEksporDokumen()->orderBy('kode_dokumen')->all();
        $kriteria = $this->getArrayKriteria($led);
        $realPath = K9ProdiDirectoryHelper::getDokumenLedUrl($ledProdi->akreditasiProdi);

        if ($modelDokumen->load(Yii::$app->request->post())) {
            $dokumen = $this->uploadDokumenLed($led);
            if ($dokumen) {
                $model = new K9ProdiEksporDokumen();
                $model->external_id = $ledProdi->id;
                $model->type = K9ProdiEksporDokumen::TYPE_LED;
                $model->nama_dokumen = $dokumen->getNamaDokumen();
                $model->bentuk_dokumen = $dokumen->getBentukDokumen();
                $model->kode_dokumen = 'uploaded';
                $model->save(false);

                Yii::$app->session->setFlash('success', 'Berhasil mengunggah Dokumen LED');
                return $this->redirect(Url::current());
            }
            Yii::$app->session->setFlash('warning', 'Gagal mengunggah Dokumen LED');
            return $this->redirect(Url::current());
        }

        return $this->render($this->lihatLedView, [
            'led' => $ledProdi,
            'modelDokumen' => $modelDokumen,
            'dataDokumen' => $dataDokumen,
            'json' => $json_kriteria,
            'json_eksternal' => $json_eksternal,
            'json_profil' => $json_profil,
            'json_analisis' => $json_analisis,
            'kriteria' => $kriteria,
            'path' => $realPath,
            'modelEksternal' => $modelEksternal,
            'modelAnalisis' => $modelAnalisis,
            'modelProfil' => $modelProfil,
            'prodi' => $programStudi,
            'untuk' => 'isi'
        ]);
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

    protected function getArrayKriteria($led)
    {
        $kriteria = [];
        for ($i = 1; $i <= 9; $i++) {
            $classpath = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiKriteria' . $i;
            $kriteria[] = call_user_func($classpath . '::findOne', ['id_led_prodi' => $led]);
        }
        return $kriteria;
    }

    protected function uploadDokumenLed($led)
    {
        $ledProdi = K9LedProdi::findOne($led);

        $dokumenLed = new K9DokumenLedProdiUploadForm();
        $dokumenLed->dokumenLed = UploadedFile::getInstance($dokumenLed, 'dokumenLed');
        $realPath = K9ProdiDirectoryHelper::getDokumenLedPath($ledProdi->akreditasiProdi);
        $response = null;

        if ($dokumenLed->validate()) {
            $uploaded = $dokumenLed->uploadDokumen($realPath);
            if ($uploaded) {
                $response = $dokumenLed;
            }
        }

        return $response;
    }

    public function actionIsiKriteria($led, $kriteria, $prodi)
    {
        $ledProdi = K9LedProdi::findOne(['id' => $led]);
        $programStudi = $ledProdi->akreditasiProdi->prodi;
        $attr = 'k9LedProdiKriteria' . $kriteria . 's';
        $modelLed = $ledProdi->$attr;

        $json = K9ProdiJsonHelper::getJsonKriteriaLed($kriteria);
        $poinKriteria = $json->butir;

        $modelNarasiClass = 'akreditasi\\models\\kriteria9\\led\\prodi\\K9LedProdiNarasiKriteria' . $kriteria . 'Form';
        $modelNarasi = call_user_func($modelNarasiClass . '::findOne',
            ['id_led_prodi_kriteria' . $kriteria => $modelLed->id]);


        $detailModel = new K9DetailLedProdiUploadForm();
        $textModel = new K9DetailLedProdiTeksForm();
        $linkModel = new K9DetailLedProdiLinkForm();

        if ($modelNarasi->load(Yii::$app->request->post())) {
            $modelNarasi->save();
            Yii::$app->session->setFlash('success', 'Berhasil Memperbarui Entri');
            return $this->redirect(Url::current());
        }
        if ($detailModel->load(Yii::$app->request->post())) {
            $detailModel->berkasDokumen = UploadedFile::getInstance($detailModel, 'berkasDokumen');

            if ($detailModel->uploadDokumen($modelLed->id, $kriteria)) {
                Yii::$app->session->setFlash('success', 'Berhasil Mengunggah Dokumen');
                return $this->redirect(Url::current());
            }

            Yii::$app->session->setFlash('warning', 'Gagal menunggah Dokumen');
            return $this->redirect(Url::current());
        }
        if ($textModel->load(Yii::$app->request->post())) {
            if ($textModel->save($led, $kriteria)) {
                Yii::$app->session->setFlash('success', 'Berhasil Menambahkan dokumen');
                return $this->redirect(Url::current());
            }
            Yii::$app->session->setFlash('warning', 'Gagal Menambahkan Dokumen');
            return $this->redirect(Url::current());
        }

        if ($linkModel->load(Yii::$app->request->post())) {
            if ($linkModel->save($led, $kriteria)) {
                Yii::$app->session->setFlash('success', 'Berhasil Menambahkan dokumen');
                return $this->redirect(Url::current());
            }
            Yii::$app->session->setFlash('warning', 'Gagal Menambahkan Dokumen');
            return $this->redirect(Url::current());
        }

        return $this->render($this->lihatKriteriaView, [
            'model' => $modelLed,
            'poinKriteria' => $poinKriteria,
            'untuk' => 'isi',
            'kriteria' => $kriteria,
            'prodi' => $programStudi,
            'ledProdi' => $ledProdi
        ]);
    }

    public function actionIsiNonKriteria($led, $prodi, $poin)
    {
        $ledProdi = $this->findLedProdi($led);
        $programStudi = $ledProdi->akreditasiProdi->prodi;

        switch ($poin) {
            case 'A':
                $modelNarasi = K9LedProdiNarasiKondisiEksternalForm::findOne(['id_led_prodi' => $ledProdi->id]);
                $json = K9ProdiJsonHelper::getJsonLedKondisiEksternal();
                break;
            case 'B':
                $modelNarasi = K9LedProdiNarasiProfilUppsForm::findOne(['id_led_prodi' => $ledProdi->id]);
                $json = K9ProdiJsonHelper::getJsonLedProfil();
                break;
            case 'D':
                $modelNarasi = K9LedProdiNarasiAnalisisForm::findOne(['id_led_prodi' => $ledProdi->id]);
                $json = K9ProdiJsonHelper::getJsonLedAnalisis();
                break;
        }

        $currentPoint = $json->butir;

        $modelLink = new K9DetailLedProdiNonKriteriaLinkForm();
        $modelUpload = new K9DetailLedProdiNonKriteriaUploadForm();
        $modelTeks = new K9DetailLedProdiNonKriteriaTeksForm();

        $untuk = 'isi';

        if ($modelNarasi->load(Yii::$app->request->post())) {
            $modelNarasi->save();
            Yii::$app->session->setFlash('success', 'Berhasil Memperbarui Entri');
            return $this->redirect(Url::current());
        }
        if ($modelUpload->load(Yii::$app->request->post())) {
            $modelUpload->berkasDokumen = UploadedFile::getInstance($modelUpload, 'berkasDokumen');

            if ($modelUpload->uploadDokumen($ledProdi->id)) {
                Yii::$app->session->setFlash('success', 'Berhasil Mengunggah Dokumen');
                return $this->redirect(Url::current());
            }

            Yii::$app->session->setFlash('warning', 'Gagal menunggah Dokumen');
            return $this->redirect(Url::current());
        }
        if ($modelTeks->load(Yii::$app->request->post())) {
            if ($modelTeks->save($led)) {
                Yii::$app->session->setFlash('success', 'Berhasil Menambahkan dokumen');
                return $this->redirect(Url::current());
            }
            Yii::$app->session->setFlash('warning', 'Gagal Menambahkan Dokumen');
            return $this->redirect(Url::current());
        }

        if ($modelLink->load(Yii::$app->request->post())) {
            if ($modelLink->save($led)) {
                Yii::$app->session->setFlash('success', 'Berhasil Menambahkan dokumen');
                return $this->redirect(Url::current());
            }
            Yii::$app->session->setFlash('warning', 'Gagal Menambahkan Dokumen');
            return $this->redirect(Url::current());
        }
        return $this->render($this->lihatNonKriteriaView,
            [
                'ledProdi' => $ledProdi,
                'json' => $json,
                'poin' => $poin,
                'modelNarasi' => $modelNarasi,
                'untuk' => $untuk,
                'prodi' => $programStudi,
                'currentPoint' => $currentPoint
            ]);
    }

    public function actionButirItem($led, $kriteria, $poin, $prodi, $untuk)
    {

        $ledProdi = K9LedProdi::findOne(['id' => $led]);
        $attr = 'k9LedProdiKriteria' . $kriteria . 's';
        $modelLed = $ledProdi->$attr;
        $detailAttr = 'k9LedProdiKriteria' . $kriteria . 'Details';
        $detail = $modelLed->$detailAttr;

        $detailCollection = Collection::make($detail);

        $json = K9ProdiJsonHelper::getJsonKriteriaLed($kriteria);
        $kriteriaCollection = new Collection($json->butir);
        $currentPoint = $kriteriaCollection->where('nomor', $poin)->first();

        $modelNarasiClass = 'akreditasi\\models\\kriteria9\\led\\prodi\\K9LedProdiNarasiKriteria' . $kriteria . 'Form';
        $modelNarasi = call_user_func($modelNarasiClass . '::findOne',
            ['id_led_prodi_kriteria' . $kriteria => $modelLed->id]);


        $detailModel = new K9DetailLedProdiUploadForm();
        $textModel = new K9DetailLedProdiTeksForm();
        $linkModel = new K9DetailLedProdiLinkForm();


        $realPath = K9ProdiDirectoryHelper::getDetailLedUrl($modelLed->ledProdi->akreditasiProdi);


        return $this->renderAjax('@akreditasi/modules/kriteria9/modules/prodi/views/led/_isi_led', [
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
            'untuk' => $untuk,
            'poin' => $poin
        ]);
    }

    public function actionButirItemNonKriteria($led, $poin, $nomor, $prodi, $untuk)
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

        $linkModel = new K9DetailLedProdiNonKriteriaLinkForm();
        $uploadModel = new K9DetailLedProdiNonKriteriaUploadForm();
        $textModel = new K9DetailLedProdiNonKriteriaTeksForm();
        $realPath = K9ProdiDirectoryHelper::getDetailLedUrl($ledProdi->akreditasiProdi);

        return $this->renderAjax('@akreditasi/modules/kriteria9/modules/prodi/views/led/_isi_led_non_kriteria', [

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
            'untuk' => $untuk
        ]);
    }

    public function actionLihat($led, $prodi)
    {
        $ledProdi = K9LedProdi::findOne($led);

        $json_kriteria = K9ProdiJsonHelper::getAllJsonLed();
        $json_eksternal = K9ProdiJsonHelper::getJsonLedKondisiEksternal();
        $json_profil = K9ProdiJsonHelper::getJsonLedProfil();
        $json_analisis = K9ProdiJsonHelper::getJsonLedAnalisis();

        $modelEksternal = K9LedProdiNarasiKondisiEksternal::findOne(['id_led_prodi' => $ledProdi->id]);
        $modelProfil = K9LedProdiNarasiProfilUpps::findOne(['id_led_prodi' => $ledProdi->id]);
        $modelAnalisis = K9LedProdiNarasiAnalisis::findOne(['id_led_prodi' => $ledProdi->id]);
        $modelDokumen = new K9DokumenLedProdiUploadForm();
        $dataDokumen = $ledProdi->getEksporDokumen()->orderBy('kode_dokumen')->all();
        $kriteria = $this->getArrayKriteria($led);
        $realPath = K9ProdiDirectoryHelper::getDokumenLedUrl($ledProdi->akreditasiProdi);


        return $this->render($this->lihatLedView, [
            'led' => $ledProdi,
            'modelDokumen' => $modelDokumen,
            'dataDokumen' => $dataDokumen,
            'json' => $json_kriteria,
            'json_eksternal' => $json_eksternal,
            'json_profil' => $json_profil,
            'json_analisis' => $json_analisis,
            'kriteria' => $kriteria,
            'path' => $realPath,
            'modelEksternal' => $modelEksternal,
            'modelAnalisis' => $modelAnalisis,
            'modelProfil' => $modelProfil,
            'prodi' => $ledProdi->akreditasiProdi->prodi,
            'untuk' => 'lihat'
        ]);
    }

    public function actionLihatKriteria($led, $kriteria, $prodi)
    {

        $ledProdi = K9LedProdi::findOne(['id' => $led]);
        $akreditasiProdi = $ledProdi->akreditasiProdi;
        $programStudi = $akreditasiProdi->prodi;
        $attr = 'k9LedProdiKriteria' . $kriteria . 's';
        $modelLed = $ledProdi->$attr;

        $json = K9ProdiJsonHelper::getJsonKriteriaLed($kriteria);
        $poinKriteria = $json->butir;
        return $this->render($this->lihatKriteriaView, [
            'model' => $modelLed,
            'poinKriteria' => $poinKriteria,
            'untuk' => 'lihat',
            'kriteria' => $kriteria,
            'prodi' => $programStudi,
            'akreditasiProdi' => $akreditasiProdi
        ]);
    }

    public function actionLihatNonKriteria($led, $prodi, $poin)
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

        return $this->render($this->lihatNonKriteriaView,
            [
                'ledProdi' => $ledProdi,
                'json' => $json,
                'poin' => $poin,
                'modelNarasi' => $modelNarasi,
                'detail' => $detail,
                'untuk' => $untuk,
                'prodi' => $programStudi,
                'akreditasiProdi' => $akreditasiProdi,
                'currentPoint' => $currentPoint
            ]
        );
    }

    public function actionHapusDetail()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $idDokumen = $data['dokumen'];
            $kriteria = $data['kriteria'];
            $idLed = $data['led'];
            $jenis = $data['bentuk'];
            $prodi = $data['prodi'];

            $namespace = 'common\\models\\kriteria9\\led\\prodi';
            $classPath = "$namespace\\K9LedProdiKriteria$kriteria" . 'Detail';
            $model = call_user_func("$classPath::findOne", $idDokumen);
            $led = K9LedProdi::findOne($idLed);
            if (!$model->bentuk_dokumen === Constants::TEXT && !$model->bentuk_dokumen === Constants::LINK) {
                $dokumenPath = K9ProdiDirectoryHelper::getDokumenLedPath($led->akreditasiProdi);
                FileHelper::unlink("$dokumenPath/$jenis/$model->isi_dokumen");
            }
            $model->delete();

            Yii::$app->session->setFlash('success', 'Berhasil menghapus dokumen');
            return $this->redirect(['led/isi-kriteria', 'led' => $idLed, 'kriteria' => $kriteria, 'prodi' => $prodi]);
        }

        return new MethodNotAllowedHttpException('Penghapusan harus sesuai prosedur.');
    }

    public function actionHapusDetailNonKriteria()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $idDokumen = $data['dokumen'];
            $poin = $data['poin'];
            $idLed = $data['led'];
            $jenis = $data['bentuk'];
            $prodi = $data['prodi'];

            $model = K9LedProdiNonKriteriaDokumen::findOne($idDokumen);
            $led = K9LedProdi::findOne($idLed);
            if (!$model->bentuk_dokumen === Constants::TEXT && !$model->bentuk_dokumen === Constants::LINK) {
                $dokumenPath = K9ProdiDirectoryHelper::getDokumenLedPath($led->akreditasiProdi);
                FileHelper::unlink("$dokumenPath/$jenis/$model->isi_dokumen");
            }
            $model->delete();

            Yii::$app->session->setFlash('success', 'Berhasil menghapus dokumen');
            return $this->redirect(['led/isi-non-kriteria', 'led' => $idLed, 'poin' => $poin, 'prodi' => $prodi]);
        }

        return new MethodNotAllowedHttpException('Penghapusan harus sesuai prosedur.');
    }

    public function actionDownloadDetail($kriteria, $dokumen, $led, $jenis)
    {
        ini_set('max_execution_time', 5 * 60);
        $led = K9LedProdi::findOne($led);
        $namespace = 'common\\models\\kriteria9\\led\\prodi';
        $className = "$namespace\\K9LedProdiKriteria$kriteria" . 'Detail';
        $model = call_user_func($className . '::findOne', $dokumen);
        $file = K9ProdiDirectoryHelper::getDokumenLedPath($led->akreditasiProdi) . "/$jenis/{$model->isi_dokumen}";
        return Yii::$app->response->sendFile($file);
    }

    public function actionDownloadDetailNonKriteria($poin, $dokumen, $led, $jenis)
    {
        ini_set('max_execution_time', 5 * 60);
        $led = K9LedProdi::findOne($led);
        $model = K9LedProdiNonKriteriaDokumen::findOne($dokumen);
        $file = K9ProdiDirectoryHelper::getDokumenLedPath($led->akreditasiProdi) . "/$jenis/{$model->isi_dokumen}";
        return Yii::$app->response->sendFile($file);
    }

    public function actionExportPartialKriteria()
    {

        $params = Yii::$app->request->post();
        $kriteria = $params['kriteria'];
        $id_led = $params['led'];
        $referer = $params['referer'];


        $ledProdi = $this->findLedProdi($id_led);

        $id = Yii::$app->queue->push(new LedProdiPartialExportJob([
            'led' => $ledProdi,
            'poinKriteria' => $kriteria,
            'jenis' => LedProdiPartialExportJob::JENIS_KRITERIA
        ]));

        if ($id) {
            Yii::$app->session->setFlash('success', 'Berhasil memasukkan ekspor ke dalam antrian.');
            return $this->redirect(['isi', 'led' => $ledProdi->id, 'prodi' => $ledProdi->akreditasiProdi->id_prodi]);
        }
        Yii::$app->session->setFlash('danger', 'Terjadi kesalahan saat memasukkan ke dalam antrian.');
        return $this->redirect($referer);
    }

    public function actionExportPartialNonKriteria()
    {

        $params = Yii::$app->request->post();
        $poin = $params['poin'];
        $id_led = $params['led'];
        $referer = $params['referer'];

        $ledProdi = $this->findLedProdi($id_led);

        $id = Yii::$app->queue->push(new LedProdiPartialExportJob([
            'led' => $ledProdi,
            'poinKriteria' => $poin,
            'jenis' => LedProdiPartialExportJob::JENIS_NONKRITERIA
        ]));

        if ($id) {
            Yii::$app->session->setFlash('success', 'Berhasil memasukkan ekspor ke dalam antrian.');
            return $this->redirect(['isi', 'led' => $ledProdi->id, 'prodi' => $ledProdi->akreditasiProdi->id_prodi]);
        }
        Yii::$app->session->setFlash('danger', 'Terjadi kesalahan saat memasukkan ke dalam antrian.');
        return $this->redirect($referer);
    }

    public function actionExportComplete()
    {

        $params = Yii::$app->request->post();
        $id_led = $params['led'];
        $referer = $params['referer'];

        $ledProdi = $this->findLedProdi($id_led);
        $id = Yii::$app->queue->push(new LedProdiCompleteExportJob([
            'led' => $ledProdi,
        ]));

        if ($id) {
            Yii::$app->session->setFlash('success', 'Berhasil memasukkan ekspor ke dalam antrian.');
        } else {
            Yii::$app->session->setFlash('danger', 'Terjadi kesalahan saat memasukkan ke dalam antrian.');

        }
        return $this->redirect($referer);
    }

    protected function getLedKriteriaNomor($kriteria, $search)
    {

        $data = K9ProdiJsonHelper::getJsonKriteriaLed($kriteria);
        $collection = new Collection($data->butir);
        return $collection->where('nomor', $search)->first();
    }
}
