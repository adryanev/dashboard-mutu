<?php


namespace akreditasi\modules\kriteria9\modules\prodi\controllers;

use akreditasi\modules\kriteria9\controllers\BaseController;
use common\helpers\FakultasDirectoryHelper;
use common\helpers\kriteria9\K9InstitusiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\helpers\UnitDirectoryHelper;
use common\models\Berkas;
use common\models\Constants;
use common\models\DetailBerkas;
use common\models\kriteria9\led\prodi\K9LedProdiNonKriteriaDokumen;
use common\models\Profil;
use common\models\ProgramStudi;
use common\models\Unit;
use common\models\unit\KegiatanUnit;
use common\models\unit\KegiatanUnitDetail;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

class ResourceController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'gunakan' => ['POST']
                ]
            ]
        ];
    }

    public function actionIndex($prodi, $kriteria, $kode, $jenis, $id_led_lk, $jenis_dokumen)
    {

        $profilInstitusi = $this->findProfilInstitusi();
        $berkasInstitusi = new ActiveDataProvider(['query' => $this->findBerkasInstitusi()]);
        $model = $this->findProdi($prodi);
        $fakultas = $model->fakultasAkademi;
        $profilFakultas = $fakultas->profil;
        $berkasFakultas = new ActiveDataProvider(['query' => $fakultas->getBerkas()]);
        $kegiatanUnit = $this->findKegiatanUnit();
        $profilUnit = $this->findUnit()->all();

        return $this->renderAjax(
            'index',
            compact(
                'model',
                'berkasFakultas',
                'kegiatanUnit',
                'profilInstitusi',
                'profilFakultas',
                'profilUnit',
                'berkasInstitusi',
                'kode',
                'jenis',
                'id_led_lk',
                'kriteria',
                'jenis_dokumen'
            )
        );
    }

    protected function findProfilInstitusi()
    {
        if ($model = Profil::findOne(['type' => Profil::TIPE_INSTITUSI])) {
            return $model;
        }

        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }

    protected function findBerkasInstitusi()
    {
        return Berkas::find()->where(['type' => Berkas::TYPE_INSTITUSI]);
    }

    /**
     * @param $id
     * @return ProgramStudi|null
     * @throws NotFoundHttpException
     */
    protected function findProdi($id)
    {

        if ($model = ProgramStudi::findOne($id)) {
            return $model;
        }

        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }

    /**
     * @return array|ActiveRecord[]
     */
    protected function findKegiatanUnit()
    {
        return KegiatanUnit::find()->all();
    }

    protected function findUnit()
    {
        if ($model = Unit::find()) {
            return $model;
        }

        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }

    public function actionLihatKegiatanDetail($id)
    {
        $detailKegiatan = KegiatanUnitDetail::findOne($id);
        $url = UnitDirectoryHelper::getUrl($detailKegiatan->kegiatanUnit->id_unit);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_detail_kegiatan', ['model' => $detailKegiatan, 'url' => $url]);
        }

        return true;
    }

    public function actionLihatBerkasDetail($id)
    {
        $detailBerkas = $this->findDetailBerkas($id);
        $url = $this->findBerkasUrl($detailBerkas);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_detail_berkas', ['model' => $detailBerkas, 'url' => $url]);
        }

        return true;
    }

    protected function findDetailBerkas($id)
    {
        if ($model = DetailBerkas::findOne($id)) {
            return $model;
        }

        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }

    protected function findBerkasUrl($detail)
    {
        $url = '';
        switch ($detail->berkas->type) {
            case Berkas::TYPE_UNIT:
                $url = UnitDirectoryHelper::getUrl($detail->berkas->owner->id);

                break;
            case Berkas::TYPE_FAKULTAS:
                $url = FakultasDirectoryHelper::getUrl($detail->berkas->owner->id);

                break;
            case Berkas::TYPE_INSTITUSI:
                $url = K9InstitusiDirectoryHelper::getUrl();

                break;
        }

        return $url;
    }

    public function actionDownloadDetail($id)
    {

        $detailBerkas = $this->findDetailBerkas($id);
        $path = $this->findBerkasUrl($detailBerkas);
        return Yii::$app->response->sendFile("$path/{$detailBerkas->isi_berkas}");
    }

    public function actionDownloadDetailKegiatan($id)
    {

        $detailBerkas = $this->findDetailKegiatan($id);
        $path = $this->findBerkasUrl($detailBerkas);
        return Yii::$app->response->sendFile("$path/{$detailBerkas->isi_file}");
    }

    protected function findDetailKegiatan($id)
    {
        if ($model = KegiatanUnitDetail::findOne($id)) {
            return $model;
        }

        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }

    public function actionGunakan()
    {
        $params = Yii::$app->request->post();
        $detail = $this->findDetailBerkas($params['id']);
        $prodi = $this->findProdi($params['prodi']);
        $kode = $params['kode'];
        $jenis = $params['jenis'];
        $id_led_lk = $params['id_led_lk'];
        $kriteria = $params['kriteria'];
        $jenis_dokumen = $params['jenis_dokumen'];
        $pathDetail = $this->findBerkasPath($detail);
        $transaction = Yii::$app->db->beginTransaction();
        $url = [];

//        $model = new ResourceProdiForm();
//        $model->id = $detail->id;
//        $model->nama = $detail->isi_berkas;
        try {
            if ($jenis === Constants::LED) {
                $detailClass = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiKriteria' . $kriteria . 'Detail';
                $detailAttr = 'id_led_prodi_kriteria' . $kriteria;
                $detailRelation = 'ledProdiKriteria' . $kriteria;
                $detailLedModel = new $detailClass;

                $detailLedModel->$detailAttr = $id_led_lk;
                $detailLedModel->kode_dokumen = $kode;
                $detailLedModel->nama_dokumen = $detail->berkas->nama_berkas;
                $detailLedModel->isi_dokumen = $detail->isi_berkas;
                $detailLedModel->jenis_dokumen = $jenis_dokumen;
                $detailLedModel->bentuk_dokumen = $detail->bentuk_berkas;

                if (!$detailLedModel->save(false)) {
                    throw new Exception('Gagal menyimpan detail');
                }
                $pathProdi = K9ProdiDirectoryHelper::getDetailLedPath($detailLedModel->$detailRelation->ledProdi->akreditasiProdi);
                copy("$pathDetail/$detail->isi_berkas", "$pathProdi/{$jenis_dokumen}/{$detail->isi_berkas}");

                $url = ['led/isi-kriteria', 'kriteria' => $kriteria, 'led' => $id_led_lk, 'prodi' => $prodi->id];

                $transaction->commit();
            } elseif ($jenis === Constants::LK) {
                $detailClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria . 'Detail';
                $detailAttrLk = 'id_lk_prodi_kriteria' . $kriteria;
                $detailLkModel = new $detailClass;
                $detailLkRelation = 'lkProdiKriteria' . $kriteria;

                $detailLkModel->$detailAttrLk = $id_led_lk;
                $detailLkModel->kode_dokumen = $kode;
                $detailLkModel->nama_dokumen = $detail->berkas->nama_berkas;
                $detailLkModel->isi_dokumen = $detail->isi_berkas;
                $detailLkModel->jenis_dokumen = $jenis_dokumen;
                $detailLkModel->bentuk_dokumen = $detail->bentuk_berkas;
                if (!$detailLkModel->save(false)) {
                    throw new Exception('Gagal menyimpan detail');
                }
                $pathProdi = K9ProdiDirectoryHelper::getDetailLkPath($detailLkModel->$detailLkRelation->lkProdi->akreditasiProdi);
                copy("$pathDetail/{$detail->isi_berkas}", "$pathProdi/$jenis_dokumen/{$detail->isi_berkas}");
                $url = ['lk/isi-kriteria', 'kriteria' => $kriteria, 'lk' => $id_led_lk, 'prodi' => $prodi->id];
                $transaction->commit();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }


        Yii::$app->session->setFlash('success', 'Berhasil Menggunakan Berkas');

        return $this->redirect($url);
    }

    protected function findBerkasPath($detail)
    {
        $path = '';
        switch ($detail->berkas->type) {
            case Berkas::TYPE_UNIT:
                $path = UnitDirectoryHelper::getPath($detail->berkas->owner->id);

                break;
            case Berkas::TYPE_FAKULTAS:
                $path = FakultasDirectoryHelper::getPath($detail->berkas->owner->id);

                break;
            case Berkas::TYPE_INSTITUSI:
                $path = K9InstitusiDirectoryHelper::getPath();

                break;
        }

        return $path;
    }

    public function actionGunakanNonKriteria()
    {
        $params = Yii::$app->request->post();
        $detail = $this->findDetailBerkas($params['id']);
        $prodi = $this->findProdi($params['prodi']);
        $kode = $params['kode'];
        $jenis = $params['bentuk'];
        $id_led_lk = $params['id_led_lk'];
        $poin = $params['poin'];
        $nomor = $params['nomor'];
        $jenis_dokumen = $params['jenis_dokumen'];
        $pathDetail = $this->findBerkasPath($detail);
        $transaction = Yii::$app->db->beginTransaction();
        $url = [];

//        $model = new ResourceProdiForm();
//        $model->id = $detail->id;
//        $model->nama = $detail->isi_berkas;
        try {
            $detailLedModel = new K9LedProdiNonKriteriaDokumen();
            $detailLedModel->id_led_prodi = $id_led_lk;

            $detailLedModel->kode_dokumen = $poin . '.' . $nomor;
            $detailLedModel->nama_dokumen = $detail->berkas->nama_berkas;
            $detailLedModel->isi_dokumen = $detail->isi_berkas;
            $detailLedModel->jenis_dokumen = $jenis_dokumen;
            $detailLedModel->bentuk_dokumen = $detail->bentuk_berkas;

            if (!$detailLedModel->save(false)) {
                throw new Exception('Gagal menyimpan detail');
            }
            $pathProdi = K9ProdiDirectoryHelper::getDetailLedPath($detailLedModel->ledProdi->akreditasiProdi);
            copy("$pathDetail/$detail->isi_berkas", "$pathProdi/{$jenis_dokumen}/{$detail->isi_berkas}");

            $url = ['led/isi-non-kriteria', 'poin' => $poin, 'led' => $id_led_lk, 'prodi' => $prodi->id];

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }


        Yii::$app->session->setFlash('success', 'Berhasil Menggunakan Berkas');

        return $this->redirect($url);
    }

    public function actionGunakanKegiatan()
    {
        $params = Yii::$app->request->post();
        $detail = $this->findDetailKegiatan($params['id']);
        $prodi = $this->findProdi($params['prodi']);
        $kode = $params['kode'];
        $jenis = $params['bentuk'];
        $id_led_lk = $params['id_led_lk'];
        $kriteria = $params['kriteria'];
        $jenis_dokumen = $params['jenis_dokumen'];
        $pathDetail = UnitDirectoryHelper::getPath($detail->kegiatanUnit->id_unit);
        $transaction = Yii::$app->db->beginTransaction();
        $url = [];

        try {
            if ($jenis === Constants::LED) {
                $detailClass = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiKriteria' . $kriteria . 'Detail';
                $detailAttr = 'id_led_prodi_kriteria' . $kriteria;
                $detailRelation = 'ledProdiKriteria' . $kriteria;
                $detailLedModel = new $detailClass;

                $detailLedModel->$detailAttr = $id_led_lk;
                $detailLedModel->kode_dokumen = $kode;
                $detailLedModel->nama_dokumen = $detail->nama_file;
                $detailLedModel->isi_dokumen = $detail->isi_file;
                $detailLedModel->jenis_dokumen = $jenis_dokumen;
                $detailLedModel->bentuk_dokumen = $detail->bentuk_file;

                if (!$detailLedModel->save(false)) {
                    throw new Exception('Gagal menyimpan detail');
                }
                $pathProdi = K9ProdiDirectoryHelper::getDetailLedPath($detailLedModel->$detailRelation->ledProdi->akreditasiProdi);
                copy("$pathDetail/$detail->isi_file", "$pathProdi/{$jenis_dokumen}/{$detail->isi_file}");

                $url = ['led/isi-kriteria', 'kriteria' => $kriteria, 'led' => $id_led_lk, 'prodi' => $prodi->id];

                $transaction->commit();
            } elseif ($jenis === Constants::LK) {
                $detailClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria . 'Detail';
                $detailAttrLk = 'id_lk_prodi_kriteria' . $kriteria;
                $detailLkModel = new $detailClass;
                $detailLkRelation = 'lkProdiKriteria' . $kriteria;

                $detailLkModel->$detailAttrLk = $id_led_lk;
                $detailLkModel->kode_dokumen = $kode;
                $detailLkModel->nama_dokumen = $detail->nama_file;
                $detailLkModel->isi_dokumen = $detail->isi_file;
                $detailLkModel->jenis_dokumen = $jenis_dokumen;
                $detailLkModel->bentuk_dokumen = $detail->bentuk_file;
                if (!$detailLkModel->save(false)) {
                    throw new Exception('Gagal menyimpan detail');
                }
                $pathProdi = K9ProdiDirectoryHelper::getDetailLkPath($detailLkModel->$detailLkRelation->lkProdi->akreditasiProdi);
                copy("$pathDetail/{$detail->isi_file}", "$pathProdi/$jenis_dokumen/{$detail->isi_file}");
                $url = ['lk/isi-kriteria', 'kriteria' => $kriteria, 'lk' => $id_led_lk, 'prodi' => $prodi->id];
                $transaction->commit();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }


        Yii::$app->session->setFlash('success', 'Berhasil Menggunakan Kegiatan');

        return $this->redirect($url);
    }

    public function actionGunakanKegiatanNonKriteria()
    {
        $params = Yii::$app->request->post();
        $detail = $this->findDetailKegiatan($params['id']);
        $prodi = $this->findProdi($params['prodi']);
        $kode = $params['kode'];
        $jenis = $params['bentuk'];
        $id_led_lk = $params['id_led_lk'];
        $poin = $params['poin'];
        $nomor = $params['nomor'];
        $jenis_dokumen = $params['jenis_dokumen'];
        $pathDetail = UnitDirectoryHelper::getPath($detail->kegiatanUnit->id_unit);
        $transaction = Yii::$app->db->beginTransaction();
        $url = [];

        try {
            $detailLedModel = new K9LedProdiNonKriteriaDokumen();
            $detailLedModel->id_led_prodi = $id_led_lk;
            $detailLedModel->kode_dokumen = $poin . '.' . $nomor;
            $detailLedModel->nama_dokumen = $detail->nama_file;
            $detailLedModel->isi_dokumen = $detail->isi_file;
            $detailLedModel->jenis_dokumen = $jenis_dokumen;
            $detailLedModel->bentuk_dokumen = $detail->bentuk_file;

            if (!$detailLedModel->save(false)) {
                throw new Exception('Gagal menyimpan detail');
            }
            $pathProdi = K9ProdiDirectoryHelper::getDetailLedPath($detailLedModel->$detailRelation->ledProdi->akreditasiProdi);
            copy("$pathDetail/$detail->isi_file", "$pathProdi/{$jenis_dokumen}/{$detail->isi_file}");

            $url = ['led/isi-non-kriteria', 'poin' => $poin, 'led' => $id_led_lk, 'prodi' => $prodi->id];

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }


        Yii::$app->session->setFlash('success', 'Berhasil Menggunakan Kegiatan');

        return $this->redirect($url);
    }

    protected function findProfilUnit()
    {
        if ($model = Profil::findAll(['type' => Profil::TIPE_UNIT])) {
            return $model;
        }

        throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
    }
}
