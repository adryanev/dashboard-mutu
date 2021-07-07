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
use yii\base\Model;

class K9DetailLedProdiLinkForm extends Model
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
        $this->_detailLedProdi->bentuk_dokumen = Constants::LINK;

        $this->_detailLedProdi->save(false);

        return $this->_detailLedProdi;

    }

}
