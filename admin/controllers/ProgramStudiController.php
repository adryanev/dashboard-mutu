<?php

namespace admin\controllers;

use common\models\FakultasAkademi;
use common\models\Profil;
use common\models\StrukturOrganisasi;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use common\models\ProgramStudi;
use admin\models\ProgramStudiSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramStudiController implements the CRUD actions for ProgramStudi model.
 */
class ProgramStudiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    ['actions'=>['index','create','update','view','delete'],
                     'allow'=>true,
                     'roles'=>['@']
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
     * Lists all ProgramStudi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProgramStudiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProgramStudi model.
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
     * Creates a new ProgramStudi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProgramStudi();
        $jenjang = ProgramStudi::JENJANG;
        $dataFakultas = ArrayHelper::map(FakultasAkademi::find()->all(),'id','nama');

        if ($model->load(Yii::$app->request->post())) {

            $db = Yii::$app->db->beginTransaction();
            try{
                $model->save();
                $profil = new Profil();
                $profil->external_id = $model->id;
                $profil->type = ProgramStudi::PROGRAM_STUDI;
                $profil->save(false);
                $db->commit();
                Yii::$app->session->setFlash('success','Berhasil menambahkan ProgramStudi.');

                return $this->redirect(['view', 'id' => $model->id]);
            }catch (Exception $e){
                $db->rollBack();
                throw $e;
            }

        }

        elseif (Yii::$app->request->isAjax){
            return $this->renderAjax('_form',['model'=>$model,'dataFakultas'=>$dataFakultas,'jenjang'=>$jenjang]);
        }

        return $this->render('create', [
            'model' => $model,
            'dataFakultas'=>$dataFakultas,
            'jenjang'=>$jenjang
        ]);
    }

    /**
     * Updates an existing ProgramStudi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $jenjang = ProgramStudi::JENJANG;

        $dataFakultas = ArrayHelper::map(FakultasAkademi::find()->all(),'id','nama');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Berhasil mengubah ProgramStudi.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dataFakultas'=>$dataFakultas,
            'jenjang'=>$jenjang
        ]);
    }

    /**
     * Deletes an existing ProgramStudi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success','Berhasil menghapus ProgramStudi.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProgramStudi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProgramStudi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProgramStudi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
