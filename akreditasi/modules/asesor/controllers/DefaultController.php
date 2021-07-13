<?php

namespace akreditasi\modules\asesor\controllers;

use common\helpers\kriteria9\K9InstitusiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\models\kriteria9\akreditasi\K9AkreditasiInstitusi;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\kriteria9\kuantitatif\institusi\K9DataKuantitatifInstitusi;
use common\models\kriteria9\kuantitatif\prodi\K9DataKuantitatifProdi;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `asesor` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $apsDataProvider = new ActiveDataProvider(['query' => K9AkreditasiProdi::find()]);
        $aptDataProvider = new ActiveDataProvider(['query' => K9AkreditasiInstitusi::find()]);

        return $this->render('index', compact('apsDataProvider', 'aptDataProvider'));
    }

    /**
     * @param $id
     * @return \yii\console\Response|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionKuantitatifProdi($id)
    {
        $kuantitatif = K9DataKuantitatifProdi::findOne(['id_akreditasi_prodi' => $id]);
        if (!$kuantitatif) {
            throw new NotFoundHttpException();
        }

        $path = K9ProdiDirectoryHelper::getKuantitatifPath($kuantitatif->akreditasiProdi);
        return Yii::$app->response->sendFile("$path/{$kuantitatif->isi_dokumen}");


    }

    /**
     * @param $id
     * @return \yii\console\Response|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionKuantitatifInstitusi($id)
    {
        $kuantitatif = K9DataKuantitatifInstitusi::findOne(['id_akreditasi_institusi' => $id]);
        if (!$kuantitatif) {
            throw new NotFoundHttpException();
        }

        $path = K9InstitusiDirectoryHelper::getKuantitatifPath($kuantitatif->akreditasiInstitusi);
        return Yii::$app->response->sendFile("$path/{$kuantitatif->isi_dokumen}");


    }
}
