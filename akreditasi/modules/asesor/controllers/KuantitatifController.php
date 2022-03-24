<?php

namespace akreditasi\modules\asesor\controllers;

use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\kriteria9\kuantitatif\prodi\K9DataKuantitatifProdi;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class KuantitatifController extends \yii\web\Controller
{

    public function actionProdi($id)
    {
        $akreditasiProdi = K9AkreditasiProdi::findOne($id);
        if (!$akreditasiProdi) {
            throw new NotFoundHttpException();
        }
        $dataProvider = new ActiveDataProvider(['query' => $akreditasiProdi->getKuantitatif()]);

        return $this->renderAjax('_list', ['dataProvider' => $dataProvider, 'untuk' => 'prodi']);
    }

    public function actionDownloadProdi($id)
    {
        $dokumen = K9DataKuantitatifProdi::findOne($id);
        if (!$dokumen) {
            throw new NotFoundHttpException();
        }

        $path = K9ProdiDirectoryHelper::getKuantitatifPath($dokumen->akreditasiProdi);
        return \Yii::$app->response->sendFile("$path/$dokumen->isi_dokumen");
    }
}
