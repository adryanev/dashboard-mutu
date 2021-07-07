<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class K9DetailLedInstitusiLinkForm
 * @package akreditasi\models\kriteria9\forms\led
 */


namespace akreditasi\models\kriteria9\forms\led;


use common\models\Constants;
use yii\base\Model;

class K9DetailLedInstitusiLinkForm extends Model
{

    public $kode_dokumen;
    public $nama_dokumen;
    public $berkasDokumen;
    public $jenis_dokumen;

    private $_detailLedInstitusi;

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

        $detailClass = 'common\\models\\kriteria9\\led\\institusi\\K9LedInstitusiKriteria'.$kriteria.'Detail';
        $detailAttr = 'id_led_institusi_kriteria'.$kriteria;
        $this->_detailLedInstitusi = new $detailClass;

        $this->_detailLedInstitusi->$detailAttr = $led;

        $this->_detailLedInstitusi->kode_dokumen = $this->kode_dokumen;
        $this->_detailLedInstitusi->nama_dokumen = $this->nama_dokumen;
        $this->_detailLedInstitusi->isi_dokumen = $this->berkasDokumen;
        $this->_detailLedInstitusi->jenis_dokumen = $this->jenis_dokumen;
        $this->_detailLedInstitusi->bentuk_dokumen = Constants::LINK;

        $this->_detailLedInstitusi->save(false);

        return $this->_detailLedInstitusi;

    }

}
