<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 8/26/2019
 * Time: 10:41 AM
 */

namespace common\models\kriteria9\forms\led;

use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\kriteria9\led\prodi\K9LedProdi;
use yii\base\Model;

class K9PencarianLedProdiForm extends Model
{

    public $akreditasi;
    public $prodi;

    private $_akreditasi;
    private $_akreditasiProdi;
    private $_led;

    public function rules()
    {
        return[
            [['akreditasi','prodi'],'required'],
            [['akreditasi','prodi'],'integer']
        ];
    }

    public function cari($target){
        $this->_akreditasi = K9Akreditasi::findOne($this->akreditasi);
        $this->_akreditasiProdi = K9AkreditasiProdi::findOne(['id_akreditasi'=> $this->_akreditasi->id,'id_prodi'=>$this->prodi]);
        if(!$this->_akreditasiProdi){
            return null;
        }

        $this->_led = K9LedProdi::findOne(['id_akreditasi_prodi'=>$this->_akreditasiProdi->id]);
        $url = ["led/$target",'led'=>$this->_led->id,'prodi'=>$this->_akreditasiProdi->id_prodi];

        return $url;
    }

    /**
     * @return mixed
     */
    public function getAkreditasi()
    {
        return $this->_akreditasi;
    }

    /**
     * @return mixed
     */
    public function getAkreditasiProdi()
    {
        return $this->_akreditasiProdi;
    }

    /**
     * @return mixed
     */
    public function getLed()
    {
        return $this->_led;
    }

}