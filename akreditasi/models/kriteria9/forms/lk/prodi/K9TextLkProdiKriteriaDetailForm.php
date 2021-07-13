<?php


namespace akreditasi\models\kriteria9\forms\lk\prodi;

use common\helpers\FileTypeHelper;
use yii\base\Model;

class K9TextLkProdiKriteriaDetailForm extends Model
{
    public $kodeDokumen;
    public $namaDokumen;
    public $isiDokumen;
    public $jenisDokumen;

    private $_dokumenLk;

    public function rules(): array
    {
        return [
            [['kodeDokumen', 'namaDokumen', 'jenisDokumen', 'isiDokumen'], 'string',],
            [['kodeDokumen', 'namaDokumen', 'jenisDokumen', 'isiDokumen'], 'required']
        ];
    }

    public function uploadText($id, $kriteria)
    {

        if ($this->validate()) {
            $detailClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria . 'Detail';
            $this->_dokumenLk = new $detailClass;

            $detailAttr = 'id_lk_prodi_kriteria' . $kriteria;
            $this->_dokumenLk->$detailAttr = $id;
            $this->_dokumenLk->nama_dokumen = $this->namaDokumen;
            $this->_dokumenLk->isi_dokumen = $this->isiDokumen;
            $this->_dokumenLk->kode_dokumen = $this->kodeDokumen;
            $this->_dokumenLk->bentuk_dokumen = FileTypeHelper::TYPE_STATIC_TEXT;
            $this->_dokumenLk->jenis_dokumen = $this->jenisDokumen;

            $this->_dokumenLk->save(false);

            return true;
        }

        return false;
    }
}
