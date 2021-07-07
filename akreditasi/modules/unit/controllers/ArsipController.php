<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 13/09/19
 * Time: 15.02
 */

namespace akreditasi\modules\unit\controllers;


use akreditasi\models\PencarianUnitForm;
use common\models\AuthAssignment;
use common\models\Unit;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ArsipController extends Controller
{

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex(){

        $model = new PencarianUnitForm();


        $idUnit = null;
        $role = AuthAssignment::findOne(['user_id'=>Yii::$app->user->identity->getId()]);
        if($role->item_name === 'unit'){
            $idUnit = Yii::$app->user->identity->profilUser->getUnit()->all();
        }
        else $idUnit = Unit::find()->all();

        $dataUnit = ArrayHelper::map($idUnit, 'id', 'nama');


        if($model->load(Yii::$app->request->post())){

            $url = $model->cari();
            if(!$url){
                throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
            }

            $this->redirect($url);

        }

        return $this->render('index',[
            'model' => $model,
            'dataUnit' => $dataUnit
        ]);
    }

}