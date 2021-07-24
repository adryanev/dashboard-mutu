<?php


namespace akreditasi\modules\api\controllers;


use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;

class BaseController extends Controller
{

    public function behaviors()
    {
        $behavior = parent::behaviors();
        $behavior['authentication'] = [
            'class'=>CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
                QueryParamAuth::class,
            ]
        ];
        return $behavior;
    }
}
