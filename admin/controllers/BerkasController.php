<?php


namespace admin\controllers;


use akreditasi\models\BerkasUploadForm;
use common\helpers\kriteria9\K9InstitusiDirectoryHelper;
use common\models\Berkas;
use common\models\DetailBerkas;
use Exception;
use Throwable;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class BerkasController extends Controller
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
                    'delete-berkas'=>['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all Berkas models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider(['query' => Berkas::find()->where(['type'=>Berkas::TYPE_INSTITUSI])]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Berkas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $url = K9InstitusiDirectoryHelper::getUrl();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'url'=>$url
        ]);
    }

    /**
     * Creates a new Berkas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Berkas();
        $detailModel = new BerkasUploadForm();
        $path = K9InstitusiDirectoryHelper::getPath();
        $urlPath = K9InstitusiDirectoryHelper::getUrl();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            $detailModel->berkas = UploadedFile::getInstances($detailModel, 'berkas');

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->type = Berkas::TYPE_INSTITUSI;
                $model->save();

                if ($files = $detailModel->upload($path)) {
                    foreach ($files as $file) {
                        $detail = new DetailBerkas();
                        $detail->id_berkas =$model->id;
                        $detail->isi_berkas = $file['isi_berkas'];
                        $detail->bentuk_berkas = $file['bentuk_berkas'];
                        $detail->save(false);
                    }
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Berhasil menambahkan Berkas.');

                return $this->redirect(['view', 'id' => $model->id]);
            } catch (Exception $exception) {
                $transaction->rollBack();
                throw $exception;
            }
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['model'=>$model,'detailModel'=>$detailModel,'urlPath'=>$urlPath]);
        }

        return $this->render('create', [
            'model' => $model,
            'detailModel'=>$detailModel,
            'urlPath'=>$urlPath
        ]);
    }

    /**
     * Updates an existing Berkas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $detailModel = new BerkasUploadForm();
        $path = K9InstitusiDirectoryHelper::getPath();
        $urlPath=  K9InstitusiDirectoryHelper::getUrl();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            $detailModel->berkas = UploadedFile::getInstances($detailModel, 'berkas');

            try {
                $model->save();

                if ($files = $detailModel->upload($path)) {
                    foreach ($files as $file) {
                        $detail = new DetailBerkas();
                        $detail->id_berkas = $model->id;
                        $detail->isi_berkas = $file['isi_berkas'];
                        $detail->bentuk_berkas = $file['bentuk_berkas'];
                        $detail->save(false);
                    }
                }

                $transaction->commit();


                Yii::$app->session->setFlash('success', 'Berhasil mengubah Berkas.');

                return $this->redirect(['view', 'id' => $model->id]);
            } catch (Exception $exception) {
                $transaction->rollBack();
                throw $exception;
            }
        }

        return $this->render('update', [
            'model' => $model,
            'detailModel'=>$detailModel,
            'urlPath'=>$urlPath
        ]);
    }

    /**
     * @return Response
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDeleteBerkas()
    {
        $id = Yii::$app->request->post('id');
        $detail = $this->findDetail($id);
        $berkas = $detail->berkas;
        $fakultas = $berkas->external_id;
        $path = K9InstitusiDirectoryHelper::getPath();
        FileHelper::unlink("$path/{$detail->isi_berkas}");
        $detail->delete();
        return $this->redirect(['berkas/update','id'=>$berkas->id]);
    }

    /**
     * @param $id
     * @return \yii\console\Response|Response
     * @throws NotFoundHttpException
     */
    public function actionDownloadBerkas($id)
    {
        $detail = $this->findDetail($id);
        $berkas = $detail->berkas;
        $path = K9InstitusiDirectoryHelper::getPath();
        return Yii::$app->response->sendFile("$path/{$detail->isi_berkas}");
    }

    /**
     * Deletes an existing Berkas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Berhasil menghapus Berkas.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Berkas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Berkas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Berkas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return DetailBerkas|null
     * @throws NotFoundHttpException
     */
    protected function findDetail($id)
    {
        if (($model = DetailBerkas::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }
}
