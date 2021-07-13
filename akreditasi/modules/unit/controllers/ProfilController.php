<?php


namespace akreditasi\modules\unit\controllers;


use akreditasi\models\kriteria9\forms\StrukturOrganisasiUploadForm;
use common\models\Profil;
use common\models\Unit;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Controller;
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

    public function actionIndex($unit)
    {
        $unitModel = Unit::findOne($unit);

        return $this->render('index',['unit'=>$unitModel]);
    }
    public function actionUpdate($unit)
    {
        $model = Unit::findOne($unit);
        $jenis = Unit::JENIS;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Berhasil mengubah Unit.');

            return $this->redirect(['default/index', 'unit' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'jenis'=>$jenis
        ]);

    }

    public function actionUpdateProfil($unit){
        $model = Unit::findOne($unit);
        /** @var Profil $profil */
        $profil = $model->profil;
        $strukturModel = new StrukturOrganisasiUploadForm();

        if($profil->load(Yii::$app->request->post()) && $strukturModel->load(Yii::$app->request->post())){

            $strukturModel->struktur = UploadedFile::getInstance($strukturModel,'struktur');
            if(isset($strukturModel->struktur)){
                $save = $strukturModel->upload($profil->type,$model->id);
                if(!$save) throw new \Exception('Error upload data');
                $profil->struktur_organisasi = $save;
            }

            if(!$profil->save(false)) throw new Exception('Gagal mengupdate profil');
            Yii::$app->session->setFlash('success','Berhasil mengupdate profil');
            return $this->redirect(['profil/index','unit'=>$model->id]);

        }

        return $this->render('update-profil',compact('model','profil','strukturModel'));
    }

    public function actionHapusStruktur(){

        $nama = Yii::$app->request->post('nama');
        $id = Yii::$app->request->post('id');

        $unit = Unit::findOne($id);
        $profil = $unit->profil;
        FileHelper::unlink(Yii::getAlias("@uploadStruktur/{$profil->type}/$id/$nama"));
        $profil->struktur_organisasi = '';


        return $profil->save(false)? true: false;
    }
}