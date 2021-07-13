<?php

namespace common\models\kriteria9\forms\kuantitatif;

use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class K9PencarianKuantitatifForm extends Model
{
    public $akreditasi;
    public $id_prodi;

    private $_akreditasi;
    private $_akreditasi_prodi;
    private $_kuantitatif;

    public function rules(): array
    {
        return [
            [['akreditasi', 'id_prodi'], 'required']
        ];
    }

    public function cari($target): array
    {

        $akreditasiProdiClass = 'common\\models\\kriteria9\\akreditasi\\K9AkreditasiProdi';
        $kuantitatifProdiClass = 'common\\models\\kriteria9\\kuantitatif\\prodi\\K9DataKuantitatifProdi';

        $this->_akreditasi = K9Akreditasi::findOne($this->akreditasi);
        if (!$this->_akreditasi) {
            throw new NotFoundHttpException();
        }
        $this->_akreditasi_prodi = K9AkreditasiProdi::findOne([
            'id_prodi' => $this->id_prodi,
            'id_akreditasi' => $this->_akreditasi->id
        ]);
        if (!$this->_akreditasi_prodi) {
            throw new NotFoundHttpException();
        }

//        $this->_akreditasi_prodi = call_user_func($akreditasiProdiClass.'::findOne',['id_prodi'=>$this->id_prodi,'id_akreditasi'=>$this->akreditasi]);
//
//        if(!$this->_akreditasi_prodi){
//            return false;
//        }
//        $this->_kuantitatif = call_user_func($kuantitatifProdiClass.'::findOne',['id_akreditasi_prodi' =>$this->_akreditasi_prodi->id]);

        return [
            'kuantitatif/' . $target,
            'akreditasiprodi' => $this->_akreditasi_prodi->id,
            'prodi' => $this->_akreditasi_prodi->id_prodi
        ];
    }

    /**
     * @return mixed
     */
    public function getKuantitatif()
    {
        return $this->_kuantitatif;
    }
}
