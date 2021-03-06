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
use yii\base\Model;
use yii\web\UploadedFile;

class K9DetailLedProdiTeksForm extends Model
{

    public $kode_dokumen;
    public $nama_dokumen;
    public $berkasDokumen;
    public $jenis_dokumen;

    private $_detailLedProdi;

    public function rules()
    {
        return [
            [['kode_dokumen','nama_dokumen','berkasDokumen','jenis_dokumen'],'required'],
            [['kode_dokumen','nama_dokumen','berkasDokumen','jenis_dokumen'],'string'],
        ];
    }

    public function save($led, $kriteria)
    {

        if(!$this->validate()){
            return false;
        }

        $detailClass = 'common\\models\\kriteria9\\led\\prodi\\K9LedProdiKriteria'.$kriteria.'Detail';
        $detailAttr = 'id_led_prodi_kriteria'.$kriteria;
        $this->_detailLedProdi = new $detailClass;

        $this->_detailLedProdi->$detailAttr = $led;

        $this->_detailLedProdi->kode_dokumen = $this->kode_dokumen;
        $this->_detailLedProdi->nama_dokumen = $this->nama_dokumen;
        $this->_detailLedProdi->isi_dokumen = $this->berkasDokumen;
        $this->_detailLedProdi->jenis_dokumen = $this->jenis_dokumen;
        $this->_detailLedProdi->bentuk_dokumen = \common\helpers\FileTypeHelper::TYPE_STATIC_TEXT;

        $this->_detailLedProdi->save(false);

        return $this->_detailLedProdi;

    }
}
