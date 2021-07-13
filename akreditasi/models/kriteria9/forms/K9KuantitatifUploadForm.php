<?php


namespace akreditasi\models\kriteria9\forms;


use Carbon\Carbon;
use yii\base\Model;
use yii\web\UploadedFile;

class K9KuantitatifUploadForm extends Model
{

    /**
     * @var UploadedFile
     */
    public $berkas;

    public function rules()
    {
        return [
            ['berkas', 'required'],
            ['berkas', 'file', 'skipOnEmpty' => false, 'extensions' => ['xlsx', 'xls']]
        ];
    }

    public function upload($path)
    {
        $tgl = Carbon::now()->timestamp;
        $fileName = $tgl . '-' . $this->berkas->baseName . '.' . $this->berkas->extension;

        return $this->berkas->saveAs("$path/$fileName") ? $fileName : null;
    }
}
