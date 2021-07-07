<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */

namespace akreditasi\models\kriteria9\forms\led;

use Carbon\Carbon;
use common\models\Constants;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class K9DokumenBorangInstitusiUploadForm
 */
class K9DokumenLedInstitusiUploadForm extends Model
{

    /** @var UploadedFile */
    public $dokumenLed;

    private $_namaDokumen;
    private $_bentukDokumen;

    public function rules()
    {
        return [
            ['dokumenLed','required'],
            ['dokumenLed','file','skipOnEmpty' => false,'extensions' => Constants::ALLOWED_EXTENSIONS]
        ];
    }

    public function uploadDokumen($realPath){
        $timestamp = Carbon::now()->timestamp;
        if(!$this->validate()){
            return null;
        }

        $filename = $timestamp. "-". $this->dokumenLed->getBaseName().'.'.$this->dokumenLed->getExtension();
        $this->_namaDokumen = $filename;
        $this->_bentukDokumen= $this->dokumenLed->getExtension();

        $this->dokumenLed->saveAs("$realPath/$filename");

        return $this->dokumenLed;
    }

    /**
     * @return mixed
     */
    public function getNamaDokumen()
    {
        return $this->_namaDokumen;
    }

    /**
     * @return mixed
     */
    public function getBentukDokumen()
    {
        return $this->_bentukDokumen;
    }
}