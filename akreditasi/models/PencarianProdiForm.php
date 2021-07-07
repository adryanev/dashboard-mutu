<?php


namespace akreditasi\models;


use common\models\ProgramStudi;
use common\models\standar7\akreditasi\S7Akreditasi;
use yii\base\Model;

/**
 *
 * @property mixed $prodi
 */
class PencarianProdiForm extends Model
{
    public $id_prodi;

    protected $_prodi;

    /**
     * @return array
     */
    public function rules() :array {
        return [
          [['id_prodi'],'required']
        ];
    }

    /**
     * @return array|null
     */
    public function cari(): ?array {

        $this->_prodi = ProgramStudi::findOne($this->id_prodi);
        if(!$this->_prodi) return null;

        $url = ['s7-prodi/default','prodi'=>$this->_prodi->id];

        return $url;
    }

    /**
     * @return array|null
     */
    public function cariK9(): ?array {

        $this->_prodi = ProgramStudi::findOne($this->id_prodi);
        if(!$this->_prodi) return null;

        return ['k9-prodi/default','prodi'=>$this->_prodi->id];
    }

    /**
     * @return mixed
     */
    public function getProdi()
    {
        return $this->_prodi;
    }




}
