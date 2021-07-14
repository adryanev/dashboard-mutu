<?php

namespace akreditasi\modules\api\controllers;

use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class DefaultController extends BaseController
{

    public function actionIndex()
    {

        return ['status'=>'success','code'=>200];
    }
}
