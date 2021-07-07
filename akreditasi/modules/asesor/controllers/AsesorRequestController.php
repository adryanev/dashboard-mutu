<?php


namespace akreditasi\modules\asesor\controllers;


use common\models\AsesorRequest;
use common\models\ProgramStudi;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class AsesorRequestController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'accept' => ['POST'],
                    'reject' => ['POST']
                ]
            ]
        ];
    }


    public function actionCreate()
    {
        $model = new AsesorRequest();
        $model->id_asesor = Yii::$app->user->identity->getId();
        $model->izinkan = false;

        $dataProdi = ArrayHelper::map(ProgramStudi::find()->all(), 'id', 'nama');
        if ($model->load(Yii::$app->request->post())) {

            $model->save(false);
            Yii::$app->session->setFlash('success', 'Berhasil meminta akses');

        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['model' => $model, 'dataProdi' => $dataProdi]);
        }

        return $this->redirect('index');

    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => AsesorRequest::find()->where(['id_asesor' => \Yii::$app->user->identity->id])]);

        return $this->render('index', compact('dataProvider'));

    }

    public function actionReject()
    {
        $params = \Yii::$app->request->post();
        $model = $this->findModel(\Yii::$app->user->identity->id, $params['prodi']);
        $model->delete();

        return $this->redirect('index');
    }

    public function findModel($asesor, $prodi)
    {
        if ($model = AsesorRequest::findOne(['id_asesor' => $asesor, 'id_prodi' => $prodi])) {
            return $model;
        }

        throw new NotFoundHttpException();
    }
}
