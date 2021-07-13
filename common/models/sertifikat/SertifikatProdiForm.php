<?php

namespace common\models\sertifikat;

use common\models\S7Akreditasi;
use yii\base\Model;

class SertifikatProdiForm extends Model
{
    public $sertifikat_untuk;

    private $_akreditasi;
    private $_akreditasi_Institusi;
    private $_sertifikat;


    public function rules() :array
    {
        return [
            [['sertifikat_untuk',],'required']
        ];
    }

    public function cari(): string
    {

        $url ='';

        $untuk = strtolower($this->sertifikat_untuk);

        if($untuk === 'prodi'){
            $this->_sertifikat = SertifikatProdi::find();
            $url .= "sertifikat-prodi";
        }

        return $url;

    }


    /**
     * @return mixed
     */
    public function getSertifikat()
    {
        return $this->_sertifikat;
    }

}