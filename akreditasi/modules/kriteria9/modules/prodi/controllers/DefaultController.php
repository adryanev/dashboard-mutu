<?php

namespace akreditasi\modules\kriteria9\modules\prodi\controllers;

use akreditasi\modules\kriteria9\controllers\BaseController;
use common\models\ProgramStudi;
use Yii;

/**
 * Default controller for the `k9-prodi` module
 */
class DefaultController extends BaseController
{
//    public function behaviors()
//    {
//        return [
//            'access'=>[
//                'class'=>'yii\filters\AccessControl',
//                'rules' => [
//                    'allow'=>true,
//                    'action'=>['index'],
//                    'roles'=>['izinProdi'],
//                    'roleParams'=>['prodi'=>Yii::$app->request->get('prodi')]
//                ]
//            ]
//        ];
//    }

    public function actionIndex()
    {
        $id_prodi = Yii::$app->request->get('prodi');

        $modelProdi = ProgramStudi::findOne(['id' => $id_prodi]);
        $profil = $modelProdi->profil;

        return $this->render('index', [
            'modelProdi' => $modelProdi,
            'profil'=>$profil
        ]);
    }
}
