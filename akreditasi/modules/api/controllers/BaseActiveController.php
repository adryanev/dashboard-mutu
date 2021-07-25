<?php


namespace akreditasi\modules\api\controllers;


use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\rest\Serializer;

class BaseActiveController extends ActiveController
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

    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items'
    ];


    public function actions()
    {
       $actions = parent::actions();
       unset($actions['delete'],$actions['create'],$actions['update']);

       return $actions;
    }
}
