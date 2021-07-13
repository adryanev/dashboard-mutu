<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */

/**
 * Class ProdiController
 * @package akreditasi\modules\kriteria9\controllers
 */


namespace akreditasi\modules\kriteria9\controllers;


use akreditasi\models\PencarianProdiForm;
use common\models\AuthAssignment;
use common\models\ProgramStudi;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class ProdiController extends BaseController
{

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionArsip()
    {

        $model = new PencarianProdiForm();
        //cek akses sesuai data
        $role = AuthAssignment::findOne(['user_id'=>Yii::$app->user->identity->getId()]);
        if($role->item_name === 'prodi' || $role->item_name === 'kaprodi') $idProdi = Yii::$app->user->identity->profilUser->getProdi()->all();
        elseif ($role->item_name === 'fakultas' || $role->item_name === 'dekanat') $idProdi = Yii::$app->user->identity->profilUser->fakultas->programStudis;
        else $idProdi = ProgramStudi::find()->all();


        $dataProdi = ArrayHelper::map($idProdi, 'id', function ($data) {
            return $data->nama . '(' . $data->jenjang . ')';
        });


        if ($model->load(Yii::$app->request->post())) {

            $url = $model->cariK9();
            if (!$url) {
                throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
            }

            $this->redirect($url);

        }

        return $this->render('arsip', [
            'model' => $model,
            'dataProdi' => $dataProdi
        ]);
    }

}