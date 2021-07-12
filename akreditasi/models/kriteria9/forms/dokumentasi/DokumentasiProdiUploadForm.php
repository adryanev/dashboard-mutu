<?php


namespace akreditasi\models\kriteria9\forms\dokumentasi;


use Carbon\Carbon;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\models\Constants;
use common\models\kriteria9\dokumentasi\prodi\DokumentasiProdi;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class DokumentasiProdiUploadForm extends Model
{

    public $nama_dokumen;
    /** @var UploadedFile */
    public $berkasDokumen;
    public $id_prodi;

    private $_dokumentasiProdi;

    public function rules()
    {
        return [
            ['dokumen', 'required'],
            ['dokumen', 'file', 'skipOnEmpty' => false, 'extensions' => Constants::ALLOWED_EXTENSIONS]
        ];
    }

    /**
     * @throws \yii\base\Exception
     */
    public function actionUpload()
    {
        $timestamp = Carbon::now()->timestamp;
        $filename = "$timestamp-{$this->berkasDokumen->name}";
        $path = K9ProdiDirectoryHelper::getDokumentasiPath($this->id_prodi);
        FileHelper::createDirectory($path);

        $this->_dokumentasiProdi = new DokumentasiProdi();
        $this->_dokumentasiProdi->id_prodi = $this->id_prodi;
        $this->_dokumentasiProdi->nama_dokumen = $this->nama_dokumen;
        $this->_dokumentasiProdi->bentuk_dokumen = $this->berkasDokumen->extension;
        $this->_dokumentasiProdi->isi_dokumen = $filename;
        $this->_dokumentasiProdi->is_verified = false;

        $this->berkasDokumen->saveAs("$path/$filename");
        $this->_dokumentasiProdi->save(false);

        return $this->_dokumentasiProdi;

    }
}
