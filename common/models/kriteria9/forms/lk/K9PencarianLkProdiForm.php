<?php


namespace common\models\kriteria9\forms\lk;


use common\models\kriteria9\akreditasi\K9Akreditasi;
use yii\base\Model;

class K9PencarianLkProdiForm extends Model
{
    public $akreditasi;
    public $id_prodi;

    private $_akreditasi;
    private $_akreditasi_prodi;
    private $_lk;

    public function rules() :array {
        return [
            [['akreditasi','id_prodi'],'required']
        ];
    }

    public function cari($target): string {
        $url = '';

        $this->_akreditasi = K9Akreditasi::find()->where(['id'=>$this->akreditasi])->one();

        $akreditasiProdiClass = 'common\\models\\kriteria9\\akreditasi\\K9AkreditasiProdi';
        $lkProdiClass = 'common\\models\\kriteria9\\lk\\prodi\\K9LkProdi';


        $this->_akreditasi_prodi = call_user_func($akreditasiProdiClass.'::findOne',['id_prodi'=>$this->id_prodi,'id_akreditasi'=>$this->akreditasi]);

        if(!$this->_akreditasi_prodi){
            return false;
        }
        $this->_lk = call_user_func($lkProdiClass.'::findOne',['id_akreditasi_prodi' =>$this->_akreditasi_prodi->id]);
        $url .= 'lk/'.$target;

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
        return $this->_akreditasi_prodi;
    }

    /**
     * @return mixed
     */
    public function getLk()
    {
        return $this->_lk;
    }

}