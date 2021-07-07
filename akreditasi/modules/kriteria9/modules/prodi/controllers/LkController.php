<?php


namespace akreditasi\modules\kriteria9\modules\prodi\controllers;

use akreditasi\models\kriteria9\forms\led\K9DokumenLedProdiUploadForm;
use akreditasi\models\kriteria9\forms\lk\prodi\K9LinkLkProdiKriteriaDetailForm;
use akreditasi\models\kriteria9\forms\lk\prodi\K9LkProdiKriteriaDetailForm;
use akreditasi\models\kriteria9\forms\lk\prodi\K9TextLkProdiKriteriaDetailForm;
use akreditasi\modules\kriteria9\controllers\BaseController;
use common\helpers\DownloadDokumenTrait;
use common\helpers\FileTypeHelper;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\jobs\LkProdiCompleteExportJob;
use common\jobs\LkProdiPartialExportJob;
use common\models\Constants;
use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\forms\lk\K9PencarianLkProdiForm;
use common\models\kriteria9\led\prodi\K9ProdiEksporDokumen;
use common\models\kriteria9\lk\prodi\K9LkProdi;
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
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii2mod\collection\Collection;

class LkController extends BaseController
{

    protected $lkView = '@akreditasi/modules/kriteria9/modules/prodi/views/lk/isi';
    protected $lihatLkKriteria = '@akreditasi/modules/kriteria9/modules/prodi/views/lk/isi-kriteria';
    protected $itemLkView = '@akreditasi/modules/kriteria9/modules/prodi/views/lk/_item_lk';
    use DownloadDokumenTrait;


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'export-partial' => ['POST'],
                    'export-complete' => ['POST']
                ]
            ]
        ];

    }

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
                return $this->renderAjax('_hasil-arsip', ['lk' => $lk, 'url' => $newUrl]);
            }
        }
        return $this->render('arsip', [
            'model' => $model,
            'dataAkreditasiProdi' => $dataAkreditasiProdi,
            'dataProdi' => $dataProdi
        ]);
    }

    public function actionIsi($lk, $prodi)
    {
        $lkProdi = $this->findLkProdi($lk);
        $programStudi = $lkProdi->akreditasiProdi->prodi;
        $json = K9ProdiJsonHelper::getAllJsonLk($programStudi->jenjang);
        $dataDokumen = $lkProdi->getEksporDokumen()->orderBy('kode_dokumen')->all();

        $kriteria = $this->getArrayKriteria($lk);
        $institusi = Yii::$app->params['institusi'];

        $modelDokumen = new K9DokumenLedProdiUploadForm();
        if ($modelDokumen->load(Yii::$app->request->post())) {
            $dokumen = $this->uploadDokumenLed($lk);
            if ($dokumen) {
                $model = new K9ProdiEksporDokumen();
                $model->external_id = $lkProdi->id;
                $model->type = K9ProdiEksporDokumen::TYPE_LK;
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

        return $this->render('@akreditasi/modules/kriteria9/modules/prodi/views/lk/isi', [
            'lkProdi' => $lkProdi,
            'kriteria' => $kriteria,
            'institusi' => $institusi,
            'json' => $json,
            'prodi' => $programStudi,
            'untuk' => 'isi',
            'dataDokumen' => $dataDokumen,
            'modelDokumen' => $modelDokumen,
            'path' => K9ProdiDirectoryHelper::getDokumenLkUrl($lkProdi->akreditasiProdi)
        ]);
    }

    /**
     * @param $id
     * @return K9LkProdi|null
     * @throws NotFoundHttpException
     */
    protected function findLkProdi($id)
    {
        $model = null;
        if ($model = K9LkProdi::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }

    protected function getArrayKriteria($lk)
    {
        $kriteria1 = K9LkProdiKriteria1::findOne(['id_lk_prodi' => $lk]);
        $kriteria2 = K9LkProdiKriteria2::findOne(['id_lk_prodi' => $lk]);
        $kriteria3 = K9LkProdiKriteria3::findOne(['id_lk_prodi' => $lk]);
        $kriteria4 = K9LkProdiKriteria4::findOne(['id_lk_prodi' => $lk]);
        $kriteria5 = K9LkProdiKriteria5::findOne(['id_lk_prodi' => $lk]);
        $kriteria6 = K9LkProdiKriteria6::findOne(['id_lk_prodi' => $lk]);
        $kriteria7 = K9LkProdiKriteria7::findOne(['id_lk_prodi' => $lk]);
        $kriteria8 = K9LkProdiKriteria8::findOne(['id_lk_prodi' => $lk]);

        return [$kriteria1, $kriteria2, $kriteria3, $kriteria4, $kriteria5, $kriteria6, $kriteria7, $kriteria8];
    }

    protected function uploadDokumenLed($led)
    {
        $ledProdi = $this->findLkProdi($led);

        $dokumenLed = new K9DokumenLedProdiUploadForm();
        $dokumenLed->dokumenLed = UploadedFile::getInstance($dokumenLed, 'dokumenLed');
        $realPath = K9ProdiDirectoryHelper::getDokumenLkPath($ledProdi->akreditasiProdi);
        $response = null;

        if ($dokumenLed->validate()) {
            $uploaded = $dokumenLed->uploadDokumen($realPath);
            if ($uploaded) {
                $response = $dokumenLed;
            }
        }

        return $response;
    }

    public function actionLihat($lk, $prodi)
    {
        $lkProdi = $this->findLkProdi($lk);
        $programStudi = $lkProdi->akreditasiProdi->prodi;
        $dataDokumen = $lkProdi->getEksporDokumen()->orderBy('kode_dokumen')->all();
        $json = K9ProdiJsonHelper::getAllJsonLk($programStudi->jenjang);
        $kriteria = $this->getArrayKriteria($lk);
        $institusi = Yii::$app->params['institusi'];

        return $this->render($this->lkView, [
            'lkProdi' => $lkProdi,
            'kriteria' => $kriteria,
            'institusi' => $institusi,
            'json' => $json,
            'prodi' => $programStudi,
            'untuk' => 'lihat',
            'dataDokumen' => $dataDokumen,
            'path' => K9ProdiDirectoryHelper::getDokumenLkUrl($lkProdi->akreditasiProdi)
        ]);
    }

    public function actionIsiKriteria($lk, $kriteria, $prodi)
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

        $dokModel = new K9LkProdiKriteriaDetailForm();
        $dokTextModel = new K9TextLkProdiKriteriaDetailForm();
        $dokLinkModel = new K9LinkLkProdiKriteriaDetailForm();

        if ($dokModel->load(Yii::$app->request->post())) {
            $dokModel->isiDokumen = UploadedFile::getInstance($dokModel, 'isiDokumen');

            if ($dokModel->uploadDokumen($lkProdiKriteria->id, $kriteria)) {
//              Alert jika nama sama belum selesai

                Yii::$app->session->setFlash('success', 'Berhasil Upload');
                return $this->redirect(Url::current());
            } else {
                Yii::$app->session->setFlash('error', 'Gagal Upload. Cek File');
                return $this->redirect(Url::current());
            }
//            return $this->redirect(Url::current());
        }

        if ($modelNarasi->load(Yii::$app->request->post())) {
            $modelNarasi->save();
            Yii::$app->session->setFlash('success', 'Berhasil Memperbarui Entri');
            return $this->redirect(Url::current());
        }


        if ($dokTextModel->load(Yii::$app->request->post())) {
            if ($dokTextModel->uploadText($lkProdiKriteria->id, $kriteria)) {
                Yii::$app->session->setFlash('success', 'Berhasil Tambah Teks');
                return $this->redirect(Url::current());
            } else {
                Yii::$app->session->setFlash('error', 'Gagal Tambah Teks');
                return $this->redirect(Url::current());
            }
        }

        if ($dokLinkModel->load(Yii::$app->request->post())) {
            if ($dokLinkModel->uploadLink($lkProdiKriteria->id, $kriteria)) {
                Yii::$app->session->setFlash('success', 'Berhasil Tambah Tautan');
                return $this->redirect(Url::current());
            } else {
                Yii::$app->session->setFlash('error', 'Gagal Tambah Tautan');
                return $this->redirect(Url::current());
            }
        }


        return $this->render($this->lihatLkKriteria, [
            'modelNarasi' => $modelNarasi,
            'lkProdi' => $lkProdi,
            'poinKriteria' => $poinKriteria,
            'modelKriteria' => $lkProdiKriteria,
            'path' => $path,
            'prodi' => $programStudi,
            'untuk' => 'isi',
            'kriteria' => $kriteria
        ]);
    }

    public function actionButirItem($lk, $prodi, $kriteria, $untuk, $poin)
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

        $dokUploadModel = new K9LkProdiKriteriaDetailForm();
        $dokTextModel = new K9TextLkProdiKriteriaDetailForm();
        $dokLinkModel = new K9LinkLkProdiKriteriaDetailForm();

        return $this->renderAjax($this->itemLkView, [
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
            'untuk' => $untuk
        ]);

    }

    protected function getKriteriaNomor($kriteria, $item, $jenis)
    {
        $data = K9ProdiJsonHelper::getJsonKriteriaLk($kriteria, $jenis);
        return Collection::make($data->butir)->where('tabel', $item)->first();
    }

    public function actionLihatKriteria($lk, $kriteria, $prodi)
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

        return $this->render($this->lihatLkKriteria, [
            'modelNarasi' => $modelNarasi,
            'lkProdi' => $lkProdi,
            'poinKriteria' => $poinKriteria,
            'modelKriteria' => $lkProdiKriteria,
            'untuk' => 'lihat',
            'prodi' => $programStudi,
            'kriteria' => $kriteria
        ]);
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

    public function actionHapusDetail()
    {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('dokumen');
            $kriteria = Yii::$app->request->post('kriteria');
            $lk = Yii::$app->request->post('lk');
            $prodi = Yii::$app->request->post('prodi');

            $namespace = 'common\\models\\kriteria9\\lk\\prodi';
            $class = $namespace . '\\K9LkProdiKriteria' . $kriteria . 'Detail';
            $model = call_user_func($class . '::findOne', $id);
            $attr = 'lkProdiKriteria' . $kriteria;


            $path = K9ProdiDirectoryHelper::getDokumenLkPath($model->$attr->lkProdi->akreditasiProdi);
            $file = $model->isi_dokumen;

            if ($model->bentuk_dokumen === FileTypeHelper::TYPE_STATIC_TEXT) {
                $model->delete();
                Yii::$app->session->setFlash('success', "Teks Tabel $model->kode_dokumen berhasil dihapus");
                return $this->redirect(['lk/isi-kriteria', 'kriteria' => $kriteria, 'lk' => $lk, 'prodi' => $prodi]);
            }
            if ($model->bentuk_dokumen === FileTypeHelper::TYPE_LINK) {
                $model->delete();
                Yii::$app->session->setFlash('success', "Tautan Tabel $model->kode_dokumen berhasil dihapus");
                return $this->redirect(['lk/isi-kriteria', 'kriteria' => $kriteria, 'lk' => $lk, 'prodi' => $prodi]);
            }

            if ($model->jenis_dokumen === Constants::LAINNYA) {
                unlink("$path/lainnya/$file");
                $model->delete();

                Yii::$app->session->setFlash('success', "Dokumen Tabel $model->kode_dokumen berhasil dihapus");
                return $this->redirect(['lk/isi-kriteria', 'kriteria' => $kriteria, 'lk' => $lk, 'prodi' => $prodi]);
            }
            if ($model->jenis_dokumen === Constants::SUMBER) {
                unlink("$path/sumber/$file");
                $model->delete();

                Yii::$app->session->setFlash('success', "Dokumen Tabel $model->kode_dokumen berhasil dihapus");
                return $this->redirect(['lk/isi-kriteria', 'kriteria' => $kriteria, 'lk' => $lk, 'prodi' => $prodi]);
            }
            if ($model->jenis_dokumen === Constants::PENDUKUNG) {
                unlink("$path/pendukung/$file");
                $model->delete();

                Yii::$app->session->setFlash('success', "Dokumen Tabel $model->kode_dokumen berhasil dihapus");
                return $this->redirect(['lk/isi-kriteria', 'kriteria' => $kriteria, 'lk' => $lk, 'prodi' => $prodi]);
            }

            unlink("$path/$file");
            $model->delete();

            Yii::$app->session->setFlash('success', "Dokumen Tabel $model->kode_dokumen berhasil dihapus");
            return $this->redirect(['lk/isi-kriteria', 'kriteria' => $kriteria, 'lk' => $lk, 'prodi' => $prodi]);
        }
        throw new MethodNotAllowedHttpException('Request Harus Post');
    }

    /**
     * @return yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionExportPartial()
    {

        $params = Yii::$app->request->post();
        $id_lk = $params['lk'];
        $tabel = $params['tabel'];
        $referer = $params['referer'];

        $lkProdi = $this->findLkProdi($id_lk);

        $id = Yii::$app->queue->push(new LkProdiPartialExportJob([
            'lk' => $lkProdi,
            'poinKriteria' => $tabel
        ]));

        if ($id) {
            Yii::$app->session->setFlash('success', 'Berhasil memasukkan ekspor ke dalam antrian.');
            return $this->redirect(['isi', 'lk' => $lkProdi->id, 'prodi' => $lkProdi->akreditasiProdi->id_prodi]);
        }
        Yii::$app->session->setFlash('danger', 'Terjadi kesalahan saat memasukkan ke dalam antrian.');
        return $this->redirect($referer);

    }

    public function actionExportComplete()
    {
        $params = Yii::$app->request->post();
        $id_lk = $params['lk'];
        $referer = $params['referer'];

        $lkProdi = $this->findLkProdi($id_lk);

        $id = Yii::$app->queue->push(new LkProdiCompleteExportJob([
            'lk' => $lkProdi
        ]));

        if ($id) {
            Yii::$app->session->setFlash('success', 'Berhasil memasukkan ekspor ke dalam antrian.');
        } else {
            Yii::$app->session->setFlash('danger', 'Terjadi kesalahan saat memasukkan ke dalam antrian.');

        }
        return $this->redirect($referer);

    }

    public function actionDownloadDokumen($dokumen)
    {
        ini_set('max_execution_time', 5 * 60);
        $model = K9ProdiEksporDokumen::findOne($dokumen);
        $file = K9ProdiDirectoryHelper::getDokumenLkPath($model->lkProdi->akreditasiProdi) . "/{$model->nama_dokumen}";
        return Yii::$app->response->sendFile($file);
    }

    public function actionHapusDokumenLk()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            $idDokumenLed = $data['id'];
            $prodi = $data['prodi'];
            $dokumenLkProdi = K9ProdiEksporDokumen::findOne($idDokumenLed);
            $path = K9ProdiDirectoryHelper::getDokumenLkPath($dokumenLkProdi->lkProdi->akreditasiProdi);
            $deleteDokumen = FileHelper::unlink($path . '/' . $dokumenLkProdi->nama_dokumen);
            if ($deleteDokumen) {
                $dokumenLkProdi->delete();
                Yii::$app->session->setFlash('success', 'Berhasil menghapus dokumen lk');
                return $this->redirect(['lk/isi', 'lk' => $dokumenLkProdi->lkProdi->id, 'prodi' => $prodi]);
            }
            Yii::$app->session->setFlash('success', 'Gagal menghapus dokumen lk');
            return $this->redirect(['lk/isi', 'lk' => $dokumenLkProdi->lkProdi->id, 'prodi' => $prodi]);
        }

        return new MethodNotAllowedHttpException('Harus melalui prosedur penghapusan data.');
    }
}
