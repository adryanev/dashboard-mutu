<?php

namespace admin\controllers;

use akreditasi\models\kriteria9\forms\StrukturOrganisasiUploadForm;
use common\models\Profil;
use Yii;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProfilController implements the CRUD actions for Profil model.
 */
class ProfilController extends Controller
{
      /**
     * Lists all ProfilInstitusi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = $this->findModel();


        return $this->render('index', [
            'model'=>$model
        ]);
    }

    /**
     * Updates an existing ProfilInstitusi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Exception
     */
    public function actionUpdate()
    {
        $model = $this->findModel();
        $strukturModel = new StrukturOrganisasiUploadForm();
        if ($model->load(Yii::$app->request->post()) && $strukturModel->load(Yii::$app->request->post())) {
            $strukturModel->struktur = UploadedFile::getInstance($strukturModel, 'struktur');
            if (isset($strukturModel->struktur)) {
                $save = $strukturModel->upload($model->type);
                if (!$save) {
                    throw new Exception('Error upload data');
                }
                $model->struktur_organisasi = $save;
            }

            if (!$model->save(false)) {
                throw new Exception('Gagal mengupdate profil');
            }
            Yii::$app->session->setFlash('success', 'Berhasil mengupdate profil');
            return $this->redirect(['profil/index']);
        }

        return $this->render('update', compact('model', 'strukturModel'));
    }


    /**
     * Finds the ProfilInstitusi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @return Profil
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel()
    {
        if (($model = Profil::findOne(['type'=>Profil::TIPE_INSTITUSI])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return bool
     * @throws NotFoundHttpException
     */
    public function actionHapusStruktur()
    {

        $nama = Yii::$app->request->post('nama');
        $profil = $this->findModel();
        FileHelper::unlink(Yii::getAlias("@uploadStruktur/{$profil->type}/$nama"));
        $profil->struktur_organisasi = '';


        return $profil->save(false);
    }
}
