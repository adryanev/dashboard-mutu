<?php
/**
 * Project: kriteria.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/7/2019
 * Time: 11:32 AM
 */

namespace akreditasi\modules\kriteria9\modules\prodi\controllers;

use akreditasi\models\kriteria9\forms\StrukturOrganisasiUploadForm;
use akreditasi\modules\kriteria9\controllers\BaseController;
use common\models\FakultasAkademi;
use common\models\Profil;
use common\models\ProgramStudi;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ProfilController extends BaseController
{

    public function behaviors()
    {
        return[
            'verbs'=>[
                'class'=>'yii\filters\VerbFilter',
                'actions' => [
                    'hapus-struktur'=>['POST']
                ]
            ]
        ];
    }

    public function actionIndex($prodi)
    {
        $programstudi = ProgramStudi::findOne($prodi);

        return $this->render('index', ['programstudi'=>$programstudi]);
    }
    public function actionUpdate($prodi)
    {
        $model = ProgramStudi::findOne($prodi);
        $dataFakultas = ArrayHelper::map(FakultasAkademi::find()->all(), 'id', 'nama');
        $jenjang = ProgramStudi::JENJANG;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Berhasil mengubah ProgramStudi.');

            return $this->redirect(['default/index', 'prodi' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dataFakultas' => $dataFakultas,
            'jenjang'=>$jenjang
        ]);
    }

    public function actionUpdateProfil($prodi)
    {
        $model = ProgramStudi::findOne($prodi);
        /** @var Profil $profil */
        $profil = $model->profil;
        $strukturModel = new StrukturOrganisasiUploadForm();

        if ($profil->load(Yii::$app->request->post()) && $strukturModel->load(Yii::$app->request->post())) {
            $strukturModel->struktur = UploadedFile::getInstance($strukturModel, 'struktur');
            if (isset($strukturModel->struktur)) {
                $save = $strukturModel->upload($profil->type, $model->id);
                if (!$save) {
                    throw new \Exception('Error upload data');
                }
                $profil->struktur_organisasi = $save;
            }

            if (!$profil->save(false)) {
                throw new Exception('Gagal mengupdate profil');
            }
            Yii::$app->session->setFlash('success', 'Berhasil mengupdate profil');
            return $this->redirect(['profil/index','prodi'=>$model->id]);
        }

        return $this->render('update-profil', compact('model', 'profil', 'strukturModel'));
    }

    public function actionHapusStruktur()
    {

        $nama = Yii::$app->request->post('nama');
        $id = Yii::$app->request->post('id');

        $prodi = ProgramStudi::findOne($id);
        $profil = $prodi->profil;
        FileHelper::unlink(Yii::getAlias("@uploadStruktur/{$profil->type}/$id/$nama"));
        $profil->struktur_organisasi = '';


        return $profil->save(false);
    }
}
