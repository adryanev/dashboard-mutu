<?php


namespace akreditasi\modules\api\controllers;


use yii\rest\ActiveController;
use yii\rest\Serializer;

class BaseActiveController extends ActiveController
{

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
