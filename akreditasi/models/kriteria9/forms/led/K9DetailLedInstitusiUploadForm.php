<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class K9DetailLedInstitusiUploadForm
 * @package akreditasi\models\kriteria9\forms\led
 */


namespace akreditasi\models\kriteria9\forms\led;


use Carbon\Carbon;
use common\helpers\kriteria9\K9InstitusiDirectoryHelper;
use common\models\Constants;
use yii\base\Model;
use yii\web\UploadedFile;

class K9DetailLedInstitusiUploadForm extends Model
{

    public $kode_dokumen;
    public $nama_dokumen;
    /** @var UploadedFile */
    public $berkasDokumen;
    public $jenis_dokumen;

    private $_detailLedInstitusi;

    public function rules()
    {
        return [
            [['kode_dokumen','nama_dokumen','berkasDokumen','jenis_dokumen'],'required'],
            [['kode_dokumen','nama_dokumen','jenis_dokumen'],'string'],
            ['berkasDokumen','file','skipOnEmpty' => false, 'extensions' => Constants::ALLOWED_EXTENSIONS]
        ];
    }

    public function uploadDokumen($led, $kriteria)
    {

        $timestamp = Carbon::now()->timestamp;

        if(!$this->validate()){
            return false;
        }

        $detailClass = 'common\\models\\kriteria9\\led\\institusi\\K9LedInstitusiKriteria'.$kriteria.'Detail';
        $detailAttr = 'id_led_institusi_kriteria'.$kriteria;
        $this->_detailLedInstitusi = new $detailClass;

        $this->_detailLedInstitusi->$detailAttr = $led;

        $fileName = $timestamp.'-'.$this->berkasDokumen->getBaseName().'.'.$this->berkasDokumen->getExtension();
        $this->_detailLedInstitusi->kode_dokumen = $this->kode_dokumen;
        $this->_detailLedInstitusi->nama_dokumen = $this->nama_dokumen;
        $this->_detailLedInstitusi->isi_dokumen = $fileName;
        $this->_detailLedInstitusi->jenis_dokumen = $this->jenis_dokumen;
        $this->_detailLedInstitusi->bentuk_dokumen = $this->berkasDokumen->getExtension();

        $ledAttr = 'ledInstitusiKriteria'.$kriteria;
        $path = K9InstitusiDirectoryHelper::getDetailLedPath($this->_detailLedInstitusi->$ledAttr->ledInstitusi->akreditasiInstitusi)."/{$this->jenis_dokumen}";
        $this->berkasDokumen->saveAs("$path/$fileName");
        $this->_detailLedInstitusi->save(false);

        return $this->_detailLedInstitusi;

    }
}