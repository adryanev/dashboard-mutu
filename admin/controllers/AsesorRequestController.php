<?php


namespace admin\controllers;


use common\models\AsesorRequest;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AsesorRequestController extends Controller
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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => AsesorRequest::find()]);

        return $this->render('index', compact('dataProvider'));

    }

    public function actionAccept()
    {
        $params = \Yii::$app->request->post();
        if (empty($params['prodi'])) {
            $model = $this->findModel($params['asesor'], null);

        } else {
            $model = $this->findModel($params['asesor'], $params['prodi']);

        }

        $model->izinkan = true;
        $model->save(false);

        return $this->redirect('index');


    }

    public function findModel($asesor, $prodi)
    {
        if ($model = AsesorRequest::findOne(['id_asesor' => $asesor, 'id_prodi' => $prodi])) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    public function actionReject()
    {
        $params = \Yii::$app->request->post();
        if (empty($params['prodi'])) {
            $model = $this->findModel($params['asesor'], null);

        } else {
            $model = $this->findModel($params['asesor'], $params['prodi']);

        }
        $model->delete();

        return $this->redirect('index');
    }
}
