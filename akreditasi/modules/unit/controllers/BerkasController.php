<?php


namespace akreditasi\modules\unit\controllers;

use akreditasi\models\BerkasUploadForm;
use common\helpers\UnitDirectoryHelper;
use common\models\Berkas;
use common\models\DetailBerkas;
use common\models\Unit;
use Exception;
use Throwable;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class BerkasController extends BaseController
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
                    'delete-berkas' => ['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all Berkas models.
     * @return mixed
     */
    public function actionIndex($unit)
    {
        $unit = $this->findUnit($unit);
        $dataProvider = new ActiveDataProvider(['query' => $unit->getBerkas()]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findUnit($id)
    {
        if (($model = Unit::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }

    /**
     * Displays a single Berkas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($unit, $id)
    {
        $url = UnitDirectoryHelper::getUrl($unit);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'url' => $url
        ]);
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
     * Creates a new Berkas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($unit)
    {
        $model = new Berkas();
        $detailModel = new BerkasUploadForm();
        $path = UnitDirectoryHelper::getPath($unit);
        $urlPath = UnitDirectoryHelper::getUrl($unit);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            $detailModel->berkas = UploadedFile::getInstances($detailModel, 'berkas');

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->external_id = $unit;
                $model->type = Berkas::TYPE_UNIT;
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
                Yii::$app->session->setFlash('success', 'Berhasil menambahkan Berkas.');

                return $this->redirect(['view', 'id' => $model->id, 'unit' => $unit]);
            } catch (Exception $exception) {
                $transaction->rollBack();
                throw $exception;
            }
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form',
                ['model' => $model, 'detailModel' => $detailModel, 'urlPath' => $urlPath]);
        }

        return $this->render('create', [
            'model' => $model,
            'detailModel' => $detailModel,
            'urlPath' => $urlPath
        ]);
    }

    /**
     * Updates an existing Berkas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($unit, $id)
    {
        $model = $this->findModel($id);
        $detailModel = new BerkasUploadForm();
        $path = UnitDirectoryHelper::getPath($unit);
        $urlPath = UnitDirectoryHelper::getUrl($unit);

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

                return $this->redirect(['view', 'id' => $model->id, 'unit' => $unit]);
            } catch (Exception $exception) {
                $transaction->rollBack();
                throw $exception;
            }
        }

        return $this->render('update', [
            'model' => $model,
            'detailModel' => $detailModel,
            'urlPath' => $urlPath
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
        $unit = $berkas->external_id;
        $path = UnitDirectoryHelper::getPath($unit);
        FileHelper::unlink("$path/{$detail->isi_berkas}");
        $detail->delete();
        return $this->redirect(['berkas/update', 'unit' => $unit, 'id' => $berkas->id]);
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

    /**
     * @param $id
     * @return \yii\console\Response|Response
     * @throws NotFoundHttpException
     */
    public function actionDownloadBerkas($id)
    {
        $detail = $this->findDetail($id);
        $berkas = $detail->berkas;
        $unit = $berkas->external_id;
        $path = UnitDirectoryHelper::getPath($unit);
        return Yii::$app->response->sendFile("$path/{$detail->isi_berkas}");
    }

    /**
     * Deletes an existing Berkas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param $unit
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($unit, $id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Berhasil menghapus Berkas.');

        return $this->redirect(['index', 'unit' => $unit]);
    }
}
