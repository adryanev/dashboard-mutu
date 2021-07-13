<?php


namespace akreditasi\models\unit;

use Carbon\Carbon;
use common\helpers\UnitDirectoryHelper;
use common\models\Constants;
use common\models\unit\KegiatanUnit;
use common\models\unit\KegiatanUnitDetail;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;

class KegiatanUnitForm extends Model
{

    public $id_unit;
    public $nama;
    public $deskripsi;
    public $waktu_mulai;
    public $waktu_selesai;

    /** @var UploadedFile */
    public $sk_kegiatan;
    /**
     * @var UploadedFile
     */
    public $laporan_kegiatan;
    /**
     * @var UploadedFile
     */
    public $absensi;
    /**
     * @var UploadedFile[]
     */
    public $foto_kegiatan;
    /** @var UploadedFile[] */
    public $sertifikat;
    /** @var UploadedFile[] */
    public $dokumen_lainnya;

    private $_kegiatan;

    public function __construct($id = null, $config = [])
    {
        if ($id !== null) {
            $this->_kegiatan = KegiatanUnit::findOne($id);
            if (!$this->_kegiatan) {
                throw new InvalidArgumentException('Tidak ditemukan');
            }
            $this->setAttributes([
                'nama'=>$this->_kegiatan->nama,
                'deskripsi'=>$this->_kegiatan->deskripsi,
                'waktu_mulai'=>$this->_kegiatan->waktu_mulai,
                'waktu_selesai'=>$this->_kegiatan->waktu_selesai
            ]);
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['nama','deskripsi','waktu_mulai','waktu_selesai'],'required'],
            [['sk_kegiatan','laporan_kegiatan','absensi','foto_kegiatan','sertifikat','dokumen_lainnya',],'safe'],
            [['sk_kegiatan','laporan_kegiatan','absensi'],'file','maxSize'=>Constants::MAX_UPLOAD_SIZE(),'extensions'=>Constants::ALLOWED_EXTENSIONS,'skipOnEmpty'=>true],
            [['foto_kegiatan','sertifikat','dokumen_lainnya'],'file','maxSize'=>Constants::MAX_UPLOAD_SIZE(),'extensions'=>Constants::ALLOWED_EXTENSIONS,'skipOnEmpty'=>true,'maxFiles'=>10]
        ];
    }

    public function save($path)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $kegiatan = new KegiatanUnit();
            $kegiatan->setAttributes([
                'id_unit'=>$this->id_unit,
                'nama'=>$this->nama,
                'deskripsi'=>$this->deskripsi,
                'waktu_mulai'=>$this->waktu_mulai,
                'waktu_selesai'=>$this->waktu_selesai
            ]);
            $kegiatan->save(false);
            $uploadFile = $this->upload($path);

            if (!empty($uploadFile)) {
                foreach ($uploadFile as $k => $file) {
                   foreach ($file as $value){
                       $detail = new KegiatanUnitDetail();
                       $detail->id_kegiatan_unit = $kegiatan->id;
                       $detail->bentuk_file = $value['bentuk_file'];
                       $detail->jenis_file = $k;
                       $detail->isi_file = $value['isi_file'];
                       $detail->nama_file = StringHelper::mb_ucfirst(str_replace('_', ' ', $k));
                       $detail->save(false);
                   }

                }
            }


            $transaction->commit();

            return $kegiatan;
        } catch (\yii\db\Exception $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }

    public function update($path)
    {
        $transaction = \Yii::$app->db->beginTransaction();

        try {
            $this->_kegiatan->setAttributes([
                'nama'=>$this->nama,
                'deskripsi'=>$this->deskripsi,
                'waktu_mulai'=>$this->waktu_mulai,
                'waktu_selesai'=>$this->waktu_selesai
            ]);
            $this->_kegiatan->save(false);
            $uploadFile = $this->upload($path);
            foreach ($uploadFile as $k => $array) {
                foreach ($array as $file) {
                    $detail = new KegiatanUnitDetail();
                    $detail->id_kegiatan_unit = $this->_kegiatan->id;
                    $detail->bentuk_file = $file['bentuk_file'];
                    $detail->jenis_file = $k;
                    $detail->isi_file = $file['isi_file'];
                    $detail->nama_file = StringHelper::mb_ucfirst(str_replace('_', ' ', $k));
                    $detail->save(false);
                }
            }

            $transaction->commit();

            return $this->_kegiatan;
        } catch (\yii\db\Exception $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }

    public function upload($path)
    {
        FileHelper::createDirectory($path);
        $allfile = [];
        if (!empty($this->sk_kegiatan)) {
            $allfile[KegiatanUnitDetail::JENIS_SK_KEGIATAN] = $this->uploadFiles($this->sk_kegiatan, $path);
        }
        if (!empty($this->absensi)) {
            $allfile[KegiatanUnitDetail::JENIS_ABSENSI] = $this->uploadFiles($this->absensi, $path);
        }
        if (!empty($this->laporan_kegiatan)) {
            $allfile[KegiatanUnitDetail::JENIS_LAPORAN_KEGIATAN] = $this->uploadFiles($this->laporan_kegiatan, $path);
        }
        if (!empty($this->foto_kegiatan)) {
            $allfile[KegiatanUnitDetail::JENIS_FOTO_KEGIATAN] = $this->uploadFiles($this->foto_kegiatan, $path);
        }
        if (!empty($this->sertifikat)) {
            $allfile[KegiatanUnitDetail::JENIS_SERTIFIKAT] = $this->uploadFiles($this->sertifikat, $path);
        }
        if (!empty($this->dokumen_lainnya)) {
            $allfile[KegiatanUnitDetail::JENIS_DOKUMEN_LAINNYA] = $this->uploadFiles($this->dokumen_lainnya, $path);
        }


        return $allfile;
    }

    /**
     * @param $attribute UploadedFile | UploadedFile[]
     * @param $path string
     * @return array
     * @throws Exception
     */
    private function uploadFiles($attribute, $path)
    {
        $now = Carbon::now()->timestamp;
        $files = [];
        if (is_array($attribute)) {
            foreach ($attribute as /** @var $file UploadedFile */ $file) {
                $filename = "$now-{$file->baseName}.{$file->extension}";
                try {
                    $file->saveAs("$path/$filename");
                    $files[] = ['isi_file'=>$filename,'bentuk_file'=>$file->extension];
                } catch (Exception $exception) {
                    throw $exception;
                }
            }
        } else {
            $filename = "$now-{$attribute->baseName}.{$attribute->extension}";
            try {
                $attribute->saveAs("$path/$filename");
                $files[] = ['isi_file'=>$filename,'bentuk_file'=>$attribute->extension];
            } catch (Exception $exception) {
                throw $exception;
            }
        }

        return $files;
    }

    /**
     * @return KegiatanUnit|null
     */
    public function getKegiatan(): ?KegiatanUnit
    {
        return $this->_kegiatan;
    }
}
