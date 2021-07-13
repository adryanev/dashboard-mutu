<?php


namespace akreditasi\models\kriteria9\forms\lk\prodi;

use Carbon\Carbon;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use yii\base\Model;

class K9TempLkProdiKriteriaDetailForm extends Model
{
    public $kodeDokumen;
    public $namaDokumen;
    public $isiDokumen;
    public $jenisDokumen;

    private $_dokumenLk;

    public function rules(): array
    {
        return [
            ['isiDokumen','file','skipOnEmpty' => false],
            [['kodeDokumen', 'namaDokumen','jenisDokumen'],'string',],
            [['kodeDokumen', 'namaDokumen','jenisDokumen'],'required']
        ];
    }

    public function uploadTemplate($id, $kriteria)
    {

        if ($this->validate()) {
            $detailClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdiKriteria' . $kriteria . 'Detail';
            $this->_dokumenLk = new $detailClass;

            $carbon = Carbon::now('Asia/Jakarta');
            $tgl = $carbon->format('U');

            $fileName = $this->isiDokumen->getBaseName() . '-' . $this->jenisDokumen . '-' . $tgl . '.' . $this->isiDokumen->getExtension();

            $detailAttr = 'id_lk_prodi_kriteria' . $kriteria;
            $this->_dokumenLk->$detailAttr = $id;
            $this->_dokumenLk->nama_dokumen = $this->namaDokumen;
            $this->_dokumenLk->isi_dokumen = $fileName;
            $this->_dokumenLk->kode_dokumen = $this->kodeDokumen;
            $this->_dokumenLk->bentuk_dokumen = $this->isiDokumen->getExtension();
            $this->_dokumenLk->jenis_dokumen = $this->jenisDokumen;

            $lkAttr = 'lkProdiKriteria' . $kriteria;
            $path = K9ProdiDirectoryHelper::getDokumenLkPath($this->_dokumenLk->$lkAttr->lkProdi->akreditasiProdi);

            $this->isiDokumen->saveAs("$path/$fileName");
            $this->_dokumenLk->save(false);

            return true;
        }

        return false;
    }
}
