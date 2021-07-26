<?php
namespace admin\controllers;

use common\models\Api;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;
use yii\filters\VerbFilter;

class ApiController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions'=>[
                    'refresh'=>['POST']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query'=>Api::find()]);

        return $this->render('index', ['dataProvider'=>$dataProvider]);
    }

    public function actionRefresh()
    {

        $data = Yii::$app->request->post('id');

        $model = Api::findOne($data);
        $model->access_token = Yii::$app->security->generateRandomString();
        $model->auth_key = Yii::$app->security->generateRandomString();

        $model->save(false);

        return $this->redirect('index');
    }
}
