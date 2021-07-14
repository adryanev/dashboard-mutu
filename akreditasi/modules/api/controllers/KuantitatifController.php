<?php


namespace akreditasi\modules\api\controllers;


use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\forms\kuantitatif\K9PencarianKuantitatifForm;
use common\models\kriteria9\kuantitatif\prodi\K9DataKuantitatifProdi;
use common\models\ProgramStudi;
use Yii;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

class KuantitatifController extends BaseActiveController
{

    public $modelClass = K9DataKuantitatifProdi::class;

    public function actionArsip($target, $prodi)
    {
        $model = new K9PencarianKuantitatifForm();

        $idAkreditasiProdi = K9Akreditasi::findAll(['jenis_akreditasi' => 'prodi']);
        $dataAkreditasiProdi = ArrayHelper::map($idAkreditasiProdi, 'id', function ($data) {
            return $data->lembaga . ' - ' . $data->nama . ' ( ' . $data->tahun . ' )';
        });

        $idProdi = ProgramStudi::findAll(['id' => $prodi]);
        $dataProdi = ArrayHelper::map($idProdi, 'id', function ($data) {
            return $data->nama . '(' . $data->jenjang . ')';
        });

        if ($model->load(Yii::$app->request->post())) {

            $url = $model->cari($target);

            return $this->redirect($url);

        }
        return [
            'model' => $model,
            'dataAkreditasiProdi' => $dataAkreditasiProdi,
            'dataProdi' => $dataProdi
        ];
    }

    public function actionDownloadDokumen($dokumen)
    {
        ini_set('max_execution_time', 5 * 60);
        $template = K9DataKuantitatifProdi::findOne($dokumen);
        $path = K9ProdiDirectoryHelper::getKuantitatifPath($template->akreditasiProdi);
        $file = $template->isi_dokumen;
        return Yii::$app->response->sendFile("$path/$file");
    }

    public function actionShow($id)
    {
        $model = K9DataKuantitatifProdi::findOne($id);
        $path = K9ProdiDirectoryHelper::getKuantitatifUrl($model->akreditasiProdi);
        return ['model' => $model, 'path' => $path];
    }
}
