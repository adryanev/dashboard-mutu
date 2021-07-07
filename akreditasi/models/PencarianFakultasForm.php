<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 8/29/2019
 * Time: 11:27 AM
 */

namespace akreditasi\models;


use common\models\FakultasAkademi;
use yii\base\Model;

class PencarianFakultasForm extends Model
{

    public $id_fakultas;

    protected $_fakultas;

    /**
     * @return array
     */
    public function rules() :array {
        return [
            [['id_fakultas'],'required']
        ];
    }

    /**
     * @return array|null
     */
    public function cari(): ?array {

        $this->_fakultas = FakultasAkademi::findOne($this->id_fakultas);
        if(!$this->_fakultas) return null;
        return ['/fakultas/default/index','fakultas'=>$this->_fakultas->id];
    }

    /**
     * @return mixed
     */
    public function getFakultas()
    {
        return $this->_fakultas;
    }
}
