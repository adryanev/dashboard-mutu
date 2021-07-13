<?php

namespace akreditasi\modules\unit\controllers;

use common\models\Unit;
use yii\web\Controller;

/**
 * Default controller for the `unit` module
 */
class DefaultController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($unit)
    {
        $unit = Unit::findOne($unit);
        $profil = $unit->profil;
        return $this->render('index',['unit'=>$unit,'profil'=>$profil]);
    }
}
