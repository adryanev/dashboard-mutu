<?php


namespace akreditasi\modules\kriteria9\modules\prodi\controllers;


use akreditasi\models\kriteria9\forms\dokumentasi\DokumentasiProdiLinkForm;
use akreditasi\models\kriteria9\forms\dokumentasi\DokumentasiProdiTeksForm;
use akreditasi\models\kriteria9\forms\dokumentasi\DokumentasiProdiUploadForm;
use akreditasi\modules\kriteria9\controllers\BaseController;
use common\helpers\FileHelper;
use common\helpers\kriteria9\DokumenJsonHelper;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\models\Constants;
use common\models\kriteria9\dokumentasi\prodi\DokumentasiProdi;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii2mod\collection\Collection;

class DokumentasiController extends BaseController
{

    public function behaviors()
    {
        return [
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions' => [
                    'hapus'=>['POST']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $dokumen = DokumenJsonHelper::getAllDokumen();
        $id_prodi = Yii::$app->request->get('prodi');
        $dokumenCollection = Collection::make(DokumentasiProdi::find()->where
        (['id_prodi' => $id_prodi])->all());
        return $this->render('index', compact('dokumen', 'dokumenCollection'));
    }

    public function actionUpload($prodi, $dokumen)
    {
        $model = new DokumentasiProdiUploadForm();
        $model->id_prodi = $prodi;
        $model->nama_dokumen = $dokumen;

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('_form', ['model' => $model, 'jenis' => 'upload']);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->berkasDokumen = UploadedFile::getInstance($model, 'berkasDokumen');
            if ($model->actionUpload()) {
                Yii::$app->session->setFlash('success', 'Berhasil mengunggah dokumen');
            } else {
                Yii::$app->session->setFlash('danger', 'Terjadi kesalahan saat mengunggah dokumen');
            }

            return $this->redirect(['dokumentasi/index', 'prodi' => $prodi]);


        }

        throw new MethodNotAllowedHttpException();
    }

    public function actionTeks($prodi, $dokumen)
    {
        $model = new DokumentasiProdiTeksForm();
        $model->id_prodi = $prodi;
        $model->nama_dokumen = $dokumen;

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('_form', ['model' => $model, 'jenis' => Constants::TEXT]);
        }
        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Berhasil menambahkan teks dokumen');
            } else {
                Yii::$app->session->setFlash('danger', 'Terjadi kesalahan saat menambahkan teks dokumen');
            }
            return $this->redirect(['dokumentasi/index', 'prodi' => $prodi]);

        }

        throw new MethodNotAllowedHttpException();

    }

    public function actionLink($prodi, $dokumen)
    {
        $model = new DokumentasiProdiLinkForm();
        $model->id_prodi = $prodi;
        $model->nama_dokumen = $dokumen;

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('_form', ['model' => $model, 'jenis' => Constants::LINK]);
        }
        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Berhasil menambahkan tautan dokumen');
            } else {
                Yii::$app->session->setFlash('danger', 'Terjadi kesalahan saat menambahkan tautan dokumen');
            }
            return $this->redirect(['dokumentasi/index', 'prodi' => $prodi]);
        }

        throw new MethodNotAllowedHttpException();

    }

    public function actionDownload($dokumen){
        $model =$this->findModel($dokumen);
        $path = K9ProdiDirectoryHelper::getDokumentasiPath($model->id_prodi);

        return Yii::$app->response->sendFile("$path/$model->isi_dokumen");
    }

    public function actionLihat($id){
        $model=$this->findModel($id);
        $path=K9ProdiDirectoryHelper::getDokumentasiUrl($model->id_prodi);

        if(Yii::$app->request->isAjax){
             return $this->renderAjax('_modal_content',compact('path','model'));
        }

        throw new MethodNotAllowedHttpException();
    }

    public function actionHapus()
    {
        $id = Yii::$app->request->post('dokumen');
        $model =$this->findModel($id);
        $prodi = $model->id_prodi;
        $file = $model->isi_dokumen;
        $dokumen = DokumenJsonHelper::getByName($model->nama_dokumen);
        $db = Yii::$app->db->beginTransaction();
        try{
            if($model->is_verified){
                //unlink file in led and lk
                //led
                $documents = ArrayHelper::merge($dokumen->relasi->led->sumber, $dokumen->relasi->led->pendukung);
                foreach ($documents as $dok){
                    $kriteria = substr($dok,'0','1');
                    $modelClass = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiKriteria'.$kriteria.'Detail';
                    call_user_func($modelClass.'::deleteAll',['kode_dokumen'=>$dok,
                        'isi_dokumen'=>$file]);
                }

                //lk
                $documentsLk = ArrayHelper::merge($dokumen->relasi->lk->sumber, $dokumen->relasi->lk->sumber);
                foreach ($documentsLk as $dok){
                    $kriteria = substr($dok,'0','1');
                    $modelClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria'.$kriteria.'Detail';
                    call_user_func($modelClass.'::deleteAll',['kode_dokumen'=>$dok, 'isi_dokumen'=>$file]);

                }
            }


            if ($model->bentuk_dokumen !== Constants::TEXT && $model->bentuk_dokumen !== Constants::LINK) {
                $dokumenPath = K9ProdiDirectoryHelper::getDokumentasiPath($prodi);
                \yii\helpers\FileHelper::unlink("$dokumenPath/{$model->isi_dokumen}");
            }
            $model->delete();
            $db->commit();
            Yii::$app->session->setFlash('success','Berhasil menghapus dokumen');
        }catch (Exception $exception){
            $db->rollBack();
            throw $exception;
        }

        return $this->redirect(['index','prodi'=>$prodi]);

    }

    private function findModel($id)
    {
        if($model = DokumentasiProdi::findOne($id)){
            return $model;
        }
        throw new NotFoundHttpException();
    }

}
