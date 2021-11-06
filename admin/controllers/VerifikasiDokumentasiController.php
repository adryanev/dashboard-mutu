<?php


namespace admin\controllers;

use common\helpers\FileHelper;
use common\helpers\FileTypeHelper;
use common\helpers\kriteria9\DokumenJsonHelper;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\models\Constants;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\kriteria9\dokumentasi\prodi\DokumentasiProdi;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;

class VerifikasiDokumentasiController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions' => [
                    'accept'=>['POST'],
                    'reject'=>['POST']
                ]
            ]
        ];
    }

    public function actionIndex()
    {

        $notVerified = new ActiveDataProvider(['query'=>DokumentasiProdi::find()->where(['is_verified'=>false])]);
        $verified = new ActiveDataProvider(['query'=>DokumentasiProdi::find()->where(['is_verified'=>true])]);

        return $this->render('index', ['notVerified'=>$notVerified,'verified'=>$verified]);
    }

    public function actionApprove()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);

        $akreditasiProdi = K9AkreditasiProdi::findOne(['id_prodi'=>$model->id_prodi]);
        $led = $akreditasiProdi->k9LedProdi;
        $lk = $akreditasiProdi->k9LkProdi;
        $dokumen = DokumenJsonHelper::getByName($model->nama_dokumen);

        $dokumentasiPath = K9ProdiDirectoryHelper::getDokumentasiPath($model->id_prodi);
        $ledPath = K9ProdiDirectoryHelper::getDetailLedPath($akreditasiProdi);
        $lkPath = K9ProdiDirectoryHelper::getDetailLkPath($akreditasiProdi);
        //unlink file in led and lk
        //led sumber
        $db = Yii::$app->db->beginTransaction();
        try {
            $model->is_verified = true;
            $model->save(false);
            foreach ($dokumen->relasi->led->sumber as $dok) {
                $kriteria = substr($dok, '0', '1');
                $modelClass = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiKriteria' . $kriteria . 'Detail';
                $ledRelation = 'k9LedProdiKriteria' . $kriteria . 's';
                $ledAttribute= 'id_led_prodi_kriteria' . $kriteria;
                $kriteriaModel = $led->$ledRelation;
                $modelDetail = new $modelClass;
                $modelDetail->$ledAttribute = $kriteriaModel->id;
                $modelDetail->kode_dokumen = $dok;
                $modelDetail->nama_dokumen = $model->nama_dokumen;
                $modelDetail->isi_dokumen = $model->isi_dokumen;
                $modelDetail->bentuk_dokumen = $model->bentuk_dokumen;
                $modelDetail->jenis_dokumen = Constants::SUMBER;
                $modelDetail->is_verified = $model->is_verified;
                $modelDetail->komentar = $model->komentar;
                $modelDetail->save(false);
            }
            foreach ($dokumen->relasi->led->pendukung as $dok) {
                $kriteria = substr($dok, '0', '1');
                $modelClass = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiKriteria' . $kriteria . 'Detail';
                $ledRelation = 'k9LedProdiKriteria' . $kriteria . 's';
                $ledAttribute= 'id_led_prodi_kriteria' . $kriteria;
                $kriteriaModel = $led->$ledRelation;
                $modelDetail = new $modelClass;
                $modelDetail->$ledAttribute = $kriteriaModel->id;
                $modelDetail->kode_dokumen = $dok;
                $modelDetail->nama_dokumen = $model->nama_dokumen;
                $modelDetail->isi_dokumen = $model->isi_dokumen;
                $modelDetail->bentuk_dokumen = $model->bentuk_dokumen;
                $modelDetail->jenis_dokumen = Constants::PENDUKUNG;
                $modelDetail->is_verified = $model->is_verified;
                $modelDetail->komentar = $model->komentar;
                $modelDetail->save(false);
            }

            //lk
            foreach ($dokumen->relasi->lk->sumber as $dok) {
                $kriteria = substr($dok, '0', '1');
                $modelClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria . 'Detail';
                $lkRelation = 'k9LkProdiKriteria' . $kriteria . 's';
                $lkAttribute= 'id_lk_prodi_kriteria' . $kriteria;
                $kriteriaModel = $lk->$lkRelation;
                $modelDetail = new $modelClass;
                $modelDetail->$lkAttribute = $kriteriaModel->id;
                $modelDetail->kode_dokumen = $dok;
                $modelDetail->nama_dokumen = $model->nama_dokumen;
                $modelDetail->isi_dokumen = $model->isi_dokumen;
                $modelDetail->bentuk_dokumen = $model->bentuk_dokumen;
                $modelDetail->jenis_dokumen = Constants::SUMBER;
                $modelDetail->is_verified = $model->is_verified;
                $modelDetail->komentar = $model->komentar;
                $modelDetail->save(false);
            }
            foreach ($dokumen->relasi->lk->pendukung as $dok) {
                $kriteria = substr($dok, '0', '1');
                $modelClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria . 'Detail';
                $lkRelation = 'k9LkProdiKriteria' . $kriteria . 's';
                $lkAttribute= 'id_lk_prodi_kriteria' . $kriteria;
                $kriteriaModel = $lk->$lkRelation;
                $modelDetail = new $modelClass;
                $modelDetail->$lkAttribute = $kriteriaModel->id;
                $modelDetail->kode_dokumen = $dok;
                $modelDetail->nama_dokumen = $model->nama_dokumen;
                $modelDetail->isi_dokumen = $model->isi_dokumen;
                $modelDetail->bentuk_dokumen = $model->bentuk_dokumen;
                $modelDetail->jenis_dokumen = Constants::PENDUKUNG;
                $modelDetail->is_verified = $model->is_verified;
                $modelDetail->komentar = $model->komentar;
                $modelDetail->save(false);
            }

            if ($model->bentuk_dokumen !== FileTypeHelper::TYPE_LINK && $model->bentuk_dokumen !==
                FileTypeHelper::TYPE_STATIC_TEXT) {
                FileHelper::createSymlink(["$ledPath/sumber/{$model->isi_dokumen}"=>"$dokumentasiPath/{$model->isi_dokumen}"]);
                FileHelper::createSymlink(["$ledPath/pendukung/{$model->isi_dokumen}"=>"$dokumentasiPath/{$model->isi_dokumen}"]);
                FileHelper::createSymlink(["$lkPath/sumber/{$model->isi_dokumen}"=>"$dokumentasiPath/{$model->isi_dokumen}"]);
                FileHelper::createSymlink(["$lkPath/pendukung/{$model->isi_dokumen}"=>"$dokumentasiPath/{$model->isi_dokumen}"]);
            }

            $db->commit();
            Yii::$app->session->setFlash('success', 'Berhasil menyetujui dokumentasi');
        } catch (Exception $exception) {
            $db->rollBack();
            throw $exception;
        }

        return $this->redirect('index');
    }

    public function actionComments($id)
    {
        $model =$this->findModel($id);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_comments', ['model'=>$model]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Berhasil menambahkan komentar');
        }

        return $this->redirect('index');
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $path = K9ProdiDirectoryHelper::getDokumentasiUrl($model->id_prodi);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_document', ['model'=>$model,'path'=>$path]);
        }

        throw new MethodNotAllowedHttpException();
    }

    private function findModel($id)
    {
        if ($model = DokumentasiProdi::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException();
    }
}
