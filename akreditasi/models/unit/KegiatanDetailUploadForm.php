<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 13/09/19
 * Time: 19.38
 */

namespace akreditasi\models\unit;


use Carbon\Carbon;
use common\models\Constants;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class KegiatanDetailUploadForm extends Model
{

    /** @var UploadedFile[] */
    public $berkas;

    private $_berkas;

    public function rules(){
        return [
            [['berkas'],'file','skipOnEmpty' => true, 'extensions' => Constants::ALLOWED_EXTENSIONS,'maxFiles' => 10,'maxSize'=>Constants::MAX_UPLOAD_SIZE()]
        ];
    }

    public function upload($path){
        if($this->validate()){
            FileHelper::createDirectory($path);
            foreach ($this->berkas as $file){
                $timestamp = Carbon::now()->timestamp;
                $filename = $timestamp.'-'.$file->getBaseName().'.'.$file->getExtension();
                $file->saveAs($path.'/'.$filename);
                $this->_berkas[] = ['filename'=>$filename,'bentuk_file'=>$file->getExtension()];
            }
            return $this->_berkas;
        }

        return false;
    }
}