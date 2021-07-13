<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class K9DetailLedProdiUploadForm
 * @package akreditasi\models\kriteria9\forms\led
 */


namespace akreditasi\models\kriteria9\forms\led;


use Carbon\Carbon;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\models\Constants;
use common\models\kriteria9\led\prodi\K9LedProdiNonKriteriaDokumen;
use yii\base\Model;
use yii\web\UploadedFile;

class K9DetailLedProdiNonKriteriaUploadForm extends Model
{

    public $kode_dokumen;
    public $nama_dokumen;
    /** @var UploadedFile */
    public $berkasDokumen;
    public $jenis_dokumen;

    /** @var K9LedProdiNonKriteriaDokumen */
    private $_detailLedProdi;

    public function rules()
    {
        return [
            [['kode_dokumen','nama_dokumen','berkasDokumen','jenis_dokumen'],'required'],
            [['kode_dokumen','nama_dokumen','jenis_dokumen'],'string'],
            ['berkasDokumen','file','skipOnEmpty' => false, 'extensions' => Constants::ALLOWED_EXTENSIONS]
        ];
    }

    public function uploadDokumen($led)
    {

        $timestamp = Carbon::now()->timestamp;

        if(!$this->validate()){
            return false;
        }

        $this->_detailLedProdi = new K9LedProdiNonKriteriaDokumen();

        $this->_detailLedProdi->id_led_prodi = $led;

        $fileName = $timestamp.'-'.$this->berkasDokumen->getBaseName().'.'.$this->berkasDokumen->getExtension();
        $this->_detailLedProdi->kode_dokumen = $this->kode_dokumen;
        $this->_detailLedProdi->nama_dokumen = $this->nama_dokumen;
        $this->_detailLedProdi->isi_dokumen = $fileName;
        $this->_detailLedProdi->jenis_dokumen = $this->jenis_dokumen;
        $this->_detailLedProdi->bentuk_dokumen = $this->berkasDokumen->getExtension();

        $path = K9ProdiDirectoryHelper::getDetailLedPath($this->_detailLedProdi->ledProdi->akreditasiProdi)."/{$this->jenis_dokumen}";
        $this->berkasDokumen->saveAs("$path/$fileName");
        $this->_detailLedProdi->save(false);

        return $this->_detailLedProdi;

    }
}
