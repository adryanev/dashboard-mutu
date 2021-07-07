<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class K9DetailLedProdiLinkForm
 * @package akreditasi\models\kriteria9\forms\led
 */


namespace akreditasi\models\kriteria9\forms\led;


use common\models\Constants;
use common\models\kriteria9\led\prodi\K9LedProdiNonKriteriaDokumen;
use yii\base\Model;

class K9DetailLedProdiNonKriteriaLinkForm extends Model
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

    public function save($led)
    {

        if(!$this->validate()){
            return false;
        }
        $this->_detailLedProdi = new K9LedProdiNonKriteriaDokumen();

        $this->_detailLedProdi->id_led_prodi = $led;
        $this->_detailLedProdi->kode_dokumen = $this->kode_dokumen;
        $this->_detailLedProdi->nama_dokumen = $this->nama_dokumen;
        $this->_detailLedProdi->isi_dokumen = $this->berkasDokumen;
        $this->_detailLedProdi->jenis_dokumen = $this->jenis_dokumen;
        $this->_detailLedProdi->bentuk_dokumen = Constants::LINK;

        $this->_detailLedProdi->save(false);

        return $this->_detailLedProdi;

    }

}
