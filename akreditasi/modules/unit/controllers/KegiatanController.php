<?php

namespace akreditasi\modules\unit\controllers;

use akreditasi\models\unit\KegiatanDetailUploadForm;
use akreditasi\models\unit\KegiatanUnitForm;
use common\helpers\UnitDirectoryHelper;
use common\models\unit\KegiatanUnitDetail;
use Yii;
use yii\filters\AccessControl;
use common\models\unit\KegiatanUnit;
use akreditasi\models\unit\KegiatanUnitSearch;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\bootstrap4\ActiveForm;
use yii\web\UploadedFile;


/**
 * KegiatanController implements the CRUD actions for KegiatanUnit model.
 */
class KegiatanController extends BaseController
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'hapus-detail'=>['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all KegiatanUnit models.
     * @return mixed
     */
    public function actionIndex($unit)
    {
        $searchModel = new KegiatanUnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KegiatanUnit model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($unit,$id)
    {
        $model = $this->findModel($id);
        $detailData = $model->kegiatanUnitDetails;
        $path = UnitDirectoryHelper::getUrl($unit);


        return $this->render('view', [
            'model' => $model,
            'detailData'=>$detailData,
            'path'=>$path
        ]);
    }

    /**
     * Creates a new KegiatanUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($unit)
    {
        $model = new KegiatanUnitForm();
        $urlPath = UnitDirectoryHelper::getUrl($unit);
        $path = UnitDirectoryHelper::getPath($unit);

//        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
//            $model->id_unit = $unit;
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return ActiveForm::validate($model);
//        }
        if ($model->load(Yii::$app->request->post())) {
            $model->id_unit = $unit;
            $model->sk_kegiatan = UploadedFile::getInstance($model,'sk_kegiatan');
            $model->absensi = UploadedFile::getInstance($model,'absensi');
            $model->laporan_kegiatan = UploadedFile::getInstance($model,'absensi');
            $model->foto_kegiatan = UploadedFile::getInstances($model,'foto_kegiatan');
            $model->sertifikat = UploadedFile::getInstances($model,'sertifikat');
            $model->dokumen_lainnya = UploadedFile::getInstances($model,'dokumen_lainnya');

            if($kegiatan = $model->save($path)){
                Yii::$app->session->setFlash('success','Berhasil menambahkan KegiatanUnit.');

                return $this->redirect(['view', 'id' => $kegiatan->id,'unit'=>$unit]);
            }


        }

        elseif (Yii::$app->request->isAjax){
            return $this->renderAjax('_form',['model'=>$model,
            'path'=>$urlPath]);
        }

        return $this->render('create', [
            'model' => $model,
            'path'=>$urlPath
        ]);
    }

    /**
     * Updates an existing KegiatanUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($unit, $id)
    {
        $model = new KegiatanUnitForm($id);
        $detailData = $model->getKegiatan()->kegiatanUnitDetails;
        $urlPath = UnitDirectoryHelper::getUrl($unit);
        $path = UnitDirectoryHelper::getPath($unit);
        if ($model->load(Yii::$app->request->post()) ) {

            $model->sk_kegiatan = UploadedFile::getInstance($model,'sk_kegiatan');
            $model->absensi = UploadedFile::getInstance($model,'absensi');
            $model->laporan_kegiatan = UploadedFile::getInstance($model,'laporan_kegiatan');
            $model->foto_kegiatan = UploadedFile::getInstances($model,'foto_kegiatan');
            $model->sertifikat = UploadedFile::getInstances($model,'sertifikat');
            $model->dokumen_lainnya = UploadedFile::getInstances($model,'dokumen_lainnya');

            if( $update = $model->update($path)){
                Yii::$app->session->setFlash('success','Berhasil mengubah KegiatanUnit.');

                return $this->redirect(['view', 'id' => $update->id,'unit'=>$unit]);
            }


        }

        return $this->render('update', [
            'model' => $model,
            'detailData'=>$detailData,
            'path'=>$urlPath
        ]);
    }

    /**
     * Deletes an existing KegiatanUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$unit)
    {
        $model= $this->findModel($id);
        $model->delete();
        Yii::$app->session->setFlash('success','Berhasil menghapus KegiatanUnit.');

        return $this->redirect(['index','unit'=>$unit]);
    }

    public function actionDownloadDetail($dokumen, $unit, $id){
        ini_set('max_execution_time', 5 * 60);
        $model = KegiatanUnitDetail::findOne($dokumen);
        $fileDokumen = UnitDirectoryHelper::getPath($unit). '/'.$model->isi_file;

        return Yii::$app->response->sendFile($fileDokumen);
    }

    public function actionHapusDetail(){
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $dokumenId = $data['dokumen'];
            $unitId = $data['unit'];
            $kegiatanId = $data['id'];

            $model = KegiatanUnitDetail::findOne($dokumenId);
            $nama_file = $model->isi_file;
            if($model->delete()){
                FileHelper::unlink(UnitDirectoryHelper::getPath($unitId).'/'.$nama_file);
            }


            Yii::$app->session->setFlash('success','Berhasil Menghapus dokumen kegiatan');
            return $this->redirect(['kegiatan/update','unit'=>$unitId,'id'=>$kegiatanId]);
        }

        throw new MethodNotAllowedHttpException('Tidak boleh mengakses ini');
    }

    /**
     * Finds the KegiatanUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KegiatanUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KegiatanUnit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
