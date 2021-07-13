<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class K9DetailLedProdiUploadForm
 * @package akreditasi\models\kriteria9\forms\led
 */


namespace akreditasi\models\kriteria9\forms\dokumentasi;


use Carbon\Carbon;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\models\Constants;
use common\models\kriteria9\dokumentasi\prodi\DokumentasiProdi;
use yii\base\Model;
use yii\web\UploadedFile;

class DokumentasiProdiTeksForm extends Model
{

    public $nama_dokumen;
    public $berkasDokumen;
    public $id_prodi;
    private $_dokumentasiProdi;

    public function rules()
    {
        return [
            [['nama_dokumen','berkasDokumen','id_prodi'],'required'],
            ['id_prodi','integer'],
            [['nama_dokumen','berkasDokumen'],'string'],
        ];
    }

    public function save()
    {

        if(!$this->validate()){
            return false;
        }
        $this->_dokumentasiProdi = new DokumentasiProdi();
        $this->_dokumentasiProdi->id_prodi = $this->id_prodi;
        $this->_dokumentasiProdi->nama_dokumen = $this->nama_dokumen;
        $this->_dokumentasiProdi->isi_dokumen = $this->berkasDokumen;
        $this->_dokumentasiProdi->bentuk_dokumen = \common\helpers\FileTypeHelper::TYPE_STATIC_TEXT;
        $this->_dokumentasiProdi->is_verified =false;
        $this->_dokumentasiProdi->save(false);

        return $this->_dokumentasiProdi;

    }
}
