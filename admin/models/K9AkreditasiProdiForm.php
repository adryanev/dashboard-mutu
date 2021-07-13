<?php


namespace admin\models;

use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\kriteria9\led\prodi\K9LedProdi;
use common\models\kriteria9\led\prodi\K9LedProdiNarasiAnalisis;
use common\models\kriteria9\led\prodi\K9LedProdiNarasiKondisiEksternal;
use common\models\kriteria9\led\prodi\K9LedProdiNarasiProfilUpps;
use common\models\kriteria9\lk\Lk;
use common\models\kriteria9\lk\prodi\K9LkProdi;
use common\models\kriteria9\lk\TabelLk;
use common\models\kriteria9\penilaian\prodi\K9PenilaianProdiAnalisis;
use common\models\kriteria9\penilaian\prodi\K9PenilaianProdiEksternal;
use common\models\kriteria9\penilaian\prodi\K9PenilaianProdiKriteria;
use common\models\kriteria9\penilaian\prodi\K9PenilaianProdiProfil;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\FileHelper;

class K9AkreditasiProdiForm extends Model
{

    public $id_akreditasi;
    public $id_prodi;

    /**
     * @var K9AkreditasiProdi
     */
    private $_akreditasiProdi;

    /**
     * @var K9LedProdi
     */
    private $_led_prodi;
    /**
     * @var K9LkProdi
     */
    private $_lk_prodi;

    public static function findOne($id)
    {

        $model = new K9AkreditasiProdiForm();
        $data = K9AkreditasiProdi::findOne($id);
        $id_akreditasi = $data->id_akreditasi;
        $model->id_prodi = $data->id_prodi;
        $model->id_akreditasi = $data->id_akreditasi;
        $model->_lk_prodi = $data->k9LkProdis;
        $model->_led_prodi = $data->k9LedProdis;

        return $model;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['id_akreditasi', 'id_prodi'], 'required'],
            [['id_prodi', 'id_akreditasi'], 'integer'],
        ];
    }

    /**
     * @throws Exception
     */
    public function createAkreditasi()
    {


        $transaction = Yii::$app->db->beginTransaction();


        try {
            $this->_akreditasiProdi = new K9AkreditasiProdi();
            $this->_akreditasiProdi->progress = 0;
            $this->_akreditasiProdi->id_akreditasi = $this->id_akreditasi;
            $this->_akreditasiProdi->id_prodi = $this->id_prodi;

            $this->_akreditasiProdi->save();

            $this->createFolder();
            $this->createLk();
            $this->createLed();
            $this->createPenilaian();

            $transaction->commit();
        } catch (\ErrorException $e) {
            $transaction->rollBack();
            throw new Exception($e->getMessage());
        }


        return true;
    }

    /**
     * @throws Exception
     */
    private function createFolder()
    {
        $uploadPath = Yii::$app->params['uploadPath'];
        $path = Yii::getAlias('@uploadAkreditasi');


        $replacementsProdi = [
            '{lembaga}' => $this->_akreditasiProdi->akreditasi->lembaga,
            '{jenis_akreditasi}' => $this->_akreditasiProdi->akreditasi->jenis_akreditasi,
            '{tahun}' => $this->_akreditasiProdi->akreditasi->tahun,
            '{level}' => 'prodi',
            '{id}' => $this->_akreditasiProdi->id_prodi,
        ];

        $resultProdi = strtr($uploadPath, $replacementsProdi);

        $pathP = $path . '/' . $resultProdi;

        $pathLedSumber = $pathP . '/led/sumber';
        $pathLedPendukung = $pathP . '/led/pendukung';
        $pathLedLainnya = $pathP . '/led/lainnya';

        $pathLkSumber = $pathP . '/lk/sumber';
        $pathLkPendukung = $pathP . '/lk/pendukung';
        $pathLkLainnya = $pathP . '/lk/lainnya';

        $pathMatriks = $pathP . '/matriks-kuantitatif';


        try {
            FileHelper::createDirectory($pathLedSumber);
            FileHelper::createDirectory($pathLedPendukung);
            FileHelper::createDirectory($pathLedLainnya);
            FileHelper::createDirectory($pathLkSumber);
            FileHelper::createDirectory($pathLkPendukung);
            FileHelper::createDirectory($pathLkLainnya);
            FileHelper::createDirectory($pathMatriks);
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function createLk()
    {
        $this->_lk_prodi = new K9LkProdi();


        $this->_lk_prodi->id_akreditasi_prodi = $this->_akreditasiProdi->id;
        $this->_lk_prodi->progress = 0;

        $this->_lk_prodi->save(false);

        $prodi = $this->_akreditasiProdi->prodi;
        $json = K9ProdiJsonHelper::getAllJsonLk($prodi->jenjang);
        foreach ($json as /** @var Lk $kriteria */ $kriteria) {
            $kritClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria->kriteria;
            $kritProdi = new $kritClass;
            $kritProdi->setAttributes([
                'id_lk_prodi' => $this->_lk_prodi->id,
                'progress_narasi' => 0,
                'progress_dokumen' => 0,
                'progress' => 0
            ]);

            $kritProdi->save(false);

            $class = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria->kriteria . 'Narasi';
            $attr = ['id_lk_prodi_kriteria' . $kriteria->kriteria => $kritProdi->id, 'progress' => 0];

            $kriteriaProdi = new $class;
            $kriteriaProdi->setAttributes($attr);
            foreach ($kriteria->butir as $key => /** @var $item TabelLk */ $item) {
                $modelAttribute = NomorKriteriaHelper::changeToDbFormat($item->tabel);
                $kriteriaProdi->$modelAttribute = $item->template;
            }

            $kriteriaProdi->save();
        }
    }

    private function createLed()
    {
        $this->_led_prodi = new K9LedProdi();


        $this->_led_prodi->id_akreditasi_prodi = $this->_akreditasiProdi->id;
        $this->_led_prodi->progress = 0;

        $this->_led_prodi->save(false);

        $attr = ['id_led_prodi' => $this->_led_prodi->id, 'progress' => 0];


        for ($i = 1; $i <= 9; $i++) {
            $kriteria_class_path = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiKriteria' . $i;
            $kriteria_narasi_class_path = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiNarasiKriteria' . $i;

            $kriteriaProdi = new $kriteria_class_path;
            $kriteriaProdi->attributes = $attr;

            $kriteriaProdi->save();

            $narasiAttr = 'id_led_prodi_kriteria' . $i;

            $narasiKriteriaProdi = new $kriteria_narasi_class_path;
            $narasiKriteriaProdi->$narasiAttr = $kriteriaProdi->id;
            $narasiKriteriaProdi->progress = 0;

            $narasiKriteriaProdi->save();
        }

        $kondisiEksternal = new K9LedProdiNarasiKondisiEksternal();
        $profilUpps = new K9LedProdiNarasiProfilUpps();
        $analisis = new K9LedProdiNarasiAnalisis();

        $kondisiEksternal->id_led_prodi = $this->_led_prodi->id;
        $kondisiEksternal->progress = 0;

        $profilUpps->id_led_prodi = $this->_led_prodi->id;
        $profilUpps->progress = 0;

        $analisis->id_led_prodi = $this->_led_prodi->id;
        $analisis->progress = 0;


        $kondisiEksternal->save();
        $profilUpps->save();
        $analisis->save();
    }

    private function createPenilaian()
    {
        $eksternal = new K9PenilaianProdiEksternal();
        $profil = new K9PenilaianProdiProfil();
        $kriteria = new K9PenilaianProdiKriteria();
        $analisis = new K9PenilaianProdiAnalisis();

        $attr = [
            'id_akreditasi_prodi' => $this->_akreditasiProdi->id,
            'status' => K9PenilaianProdiAnalisis::STATUS_READY
        ];
        $eksternal->setAttributes($attr);
        $profil->setAttributes($attr);
        $kriteria->setAttributes($attr);
        $analisis->setAttributes($attr);

        $eksternal->save(false);
        $profil->save(false);
        $kriteria->save(false);
        $analisis->save(false);
    }
}
