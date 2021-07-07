<?php

namespace admin\controllers;

use Carbon\Carbon;
use common\models\ProgramStudi;
use common\models\sertifikat\SertifikatProdi;
use common\models\sertifikat\SertifikatProdiSearch;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;


/**
 * SertifikatProdiController implements the CRUD actions for SertifikatProdi model.
 */
class SertifikatProdiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['index', 'create', 'update', 'view', 'delete', 'lihat-sertifikat', 'lihat-sk'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SertifikatProdi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SertifikatProdiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SertifikatProdi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the SertifikatProdi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SertifikatProdi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SertifikatProdi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new SertifikatProdi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SertifikatProdi();

        $idProdi = ProgramStudi::find()->all();
        $dataProdi = ArrayHelper::map($idProdi, 'id', function ($data) {
            return $data->nama . "({$data->jenjang})";
        });

        $idSertifikat = SertifikatProdi::find()->all();
        //unset prodi yg sudah upload sertifikat
        foreach ($idSertifikat as $value):
            unset($dataProdi[$value['id_prodi']]);
        endforeach;


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {

//          ganti direktori ke folder upload Admin
            $path = Yii::getAlias('@uploadAdmin/sertifikat');
            $carbon = Carbon::now();
            $tgl = $carbon->timestamp;

            $file = UploadedFile::getInstance($model, 'sertifikat');
            $fileName = $file->getBaseName() . '-sertifikat-' . $tgl . '.' . $file->getExtension();
            $model->sertifikat = $fileName;
            $file->saveAs($path . '/' . $fileName);

            $doksk = UploadedFile::getInstance($model, 'dokumen_sk');
            $fileNameSk = $doksk->getBaseName() . '-dokumen_sk-' . $tgl . '.' . $doksk->getExtension();
            $model->dokumen_sk = $fileNameSk;
            $doksk->saveAs($path . '/' . $fileNameSk);


            $model->save(false);
            Yii::$app->session->setFlash('success', 'Berhasil menambahkan SertifikatProdi.');

            return $this->redirect(['sertifikat-prodi/index']);
//            return $this->redirect(['view', 'id' => $model->id]);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['model' => $model, 'dataProdi' => $dataProdi]);
        }


        return $this->render('create', [
            'model' => $model,
            'dataProdi' => $dataProdi
        ]);
    }

    /**
     * Updates an existing SertifikatProdi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $temp1 = $model->sertifikat;
        $model->sertifikat = $temp1;

        $temp2 = $model->dokumen_sk;
        $model->dokumen_sk = $temp2;


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

//            handler file upload
            $path = Yii::getAlias('@uploadAdmin/sertifikat');
            $carbon = Carbon::now();
            $tgl = $carbon->timestamp;

            $file1 = UploadedFile::getInstance($model, 'sertifikat');
            if ($file1) {
                unlink(Yii::getAlias('@uploadAdmin/sertifikat/' . $temp1));
                $fileName = $file1->getBaseName() . '-sertifikat-' . $tgl . '.' . $file1->getExtension();
                $model->sertifikat = $fileName;
                $file1->saveAs($path . '/' . $fileName);
            } else {
                $model->sertifikat = $temp1;
            }
            $file2 = UploadedFile::getInstance($model, 'dokumen_sk');
            if ($file2) {
                unlink(Yii::getAlias('@uploadAdmin/sertifikat/' . $temp2));
                $fileName = $file2->getBaseName() . '-dokumen_sk-' . $tgl . '.' . $file2->getExtension();
                $model->dokumen_sk = $fileName;
                $file2->saveAs($path . '/' . $fileName);
            } else {
                $model->dokumen_sk = $temp2;
            }

            $model->save(false);

            Yii::$app->session->setFlash('success', 'Berhasil mengubah SertifikatProdi.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SertifikatProdi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        unlink(Yii::getAlias('@uploadAdmin/sertifikat/' . $this->findModel($id)->sertifikat));
        unlink(Yii::getAlias('@uploadAdmin/sertifikat/' . $this->findModel($id)->dokumen_sk));
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Berhasil menghapus Sertifikat Prodi.');

        return $this->redirect(['index']);
    }

    public function actionLihatSertifikat($id)
    {
        return $this->redirect(Url::to('@web/upload/sertifikat/' . $this->findModel($id)->sertifikat));
    }

    public function actionLihatSk($id)
    {
        return $this->redirect(Url::to('@web/upload/sertifikat/' . $this->findModel($id)->dokumen_sk));
    }
}
