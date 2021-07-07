<?php


namespace akreditasi\modules\kriteria9\modules\prodi\controllers;


use akreditasi\models\kriteria9\forms\K9KuantitatifUploadForm;
use akreditasi\modules\kriteria9\controllers\BaseController;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\jobs\KuantitatifProdiExportJob;
use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\kriteria9\forms\kuantitatif\K9PencarianKuantitatifForm;
use common\models\kriteria9\kuantitatif\prodi\K9DataKuantitatifProdi;
use common\models\ProgramStudi;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class KuantitatifController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'export' => ['POST']

                ]
            ]
        ];
    }

    public function actionArsip($target, $prodi)
    {
        $model = new K9PencarianKuantitatifForm();

        $idAkreditasiProdi = K9Akreditasi::findAll(['jenis_akreditasi' => 'prodi']);
        $dataAkreditasiProdi = ArrayHelper::map($idAkreditasiProdi, 'id', function ($data) {
            return $data->lembaga . ' - ' . $data->nama . ' ( ' . $data->tahun . ' )';
        });

        $idProdi = ProgramStudi::findAll(['id' => $prodi]);
        $dataProdi = ArrayHelper::map($idProdi, 'id', function ($data) {
            return $data->nama . '(' . $data->jenjang . ')';
        });

        if ($model->load(Yii::$app->request->post())) {

            $url = $model->cari($target);

            return $this->redirect($url);

        }
        return $this->render('arsip', [
            'model' => $model,
            'dataAkreditasiProdi' => $dataAkreditasiProdi,
            'dataProdi' => $dataProdi
        ]);
    }

    public function actionIsi($akreditasiprodi, $prodi)
    {

        $akreditasiProdi = K9AkreditasiProdi::findOne($akreditasiprodi);
        if (!$akreditasiProdi) {
            throw new NotFoundHttpException();
        }

        $programStudi = $akreditasiProdi->prodi;

        $dataKuantitatifProdi = new ActiveDataProvider(['query' => K9DataKuantitatifProdi::find()->where(['id_akreditasi_prodi' => $akreditasiProdi->id])]);
        $model = new K9DataKuantitatifProdi();
        $modelUpload = new K9KuantitatifUploadForm();
        $model->id_akreditasi_prodi = $akreditasiProdi->id;
        $model->nama_dokumen = 'Matriks Kuantitatif ' . $akreditasiProdi->prodi->nama . ' (' . $akreditasiProdi->akreditasi->tahun . ')';
        $model->sumber = K9DataKuantitatifProdi::SUMBER_UNGGAH;

        $path = K9ProdiDirectoryHelper::getKuantitatifPath($model->akreditasiProdi);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['model' => $model, 'modelUpload' => $modelUpload]);
        }

        if ($model->load(Yii::$app->request->post())) {


            $file = UploadedFile::getInstance($modelUpload, 'berkas');
            $modelUpload->berkas = $file;
            if (!($fileName = $modelUpload->upload($path))) {
                throw new Exception("Gagal Mengupload File");
            }
            $model->isi_dokumen = $fileName;

            if (!$model->save()) {
                throw new Exception("Gagal Menyimpan Data Kuantitatif");
            }
            Yii::$app->session->setFlash('success', 'Berhasil Mengupload Dokumen Kuantitatif.');
            $this->redirect(Url::current());

        }

        return $this->render('isi', [
            'akreditasiProdi' => $akreditasiProdi,
            'dataKuantitatifProdi' => $dataKuantitatifProdi,
            'prodi' => $programStudi,
        ]);
    }

    public function actionExport()
    {
        $params = Yii::$app->request->post();
        $akreditasiProdi = K9AkreditasiProdi::findOne([$params['akreditasiprodi']]);
        $prodi = $akreditasiProdi->prodi;

        $laporanKinerja = $akreditasiProdi->k9LkProdi;
        $path = K9ProdiDirectoryHelper::getKuantitatifTemplate();
        $id = Yii::$app->queue->push(new KuantitatifProdiExportJob(['template' => $path, 'lk' => $laporanKinerja]));

        if ($id) {
            Yii::$app->session->setFlash('success', 'Berhasil membuat data kuantitatif, silahkan ditunggu.');
        }
        return $this->redirect(['isi', 'akreditasiprodi' => $akreditasiProdi->id, 'prodi' => $prodi->id]);
    }

    public function actionDownloadDokumen($dokumen, $prodi)
    {
        ini_set('max_execution_time', 5 * 60);
        $template = K9DataKuantitatifProdi::findOne($dokumen);
        $path = K9ProdiDirectoryHelper::getKuantitatifPath($template->akreditasiProdi);
        $file = $template->isi_dokumen;
        return Yii::$app->response->sendFile("$path/$file");
    }

    public function actionHapusDokumen()
    {
        if (Yii::$app->request->isPost) {

            $id = Yii::$app->request->post('id');
            $prodi = Yii::$app->request->post('prodi');

            $model = K9DataKuantitatifProdi::findOne($id);
            $path = K9ProdiDirectoryHelper::getKuantitatifPath($model->akreditasiProdi);
            $file = $model->nama_dokumen;

            unlink("$path/$file");

            $model->delete();

            Yii::$app->session->setFlash('success', 'Berhasil Menghapus Data');
            return $this->redirect(['kuantitatif/isi', 'prodi' => $prodi]);

        }

        throw new BadRequestHttpException('Request Harus Post');
    }

    public function actionShow($id)
    {
        $model = K9DataKuantitatifProdi::findOne($id);
        $path = K9ProdiDirectoryHelper::getKuantitatifUrl($model->akreditasiProdi);
        return $this->renderAjax('_document', ['model' => $model, 'path' => $path]);
    }
}
