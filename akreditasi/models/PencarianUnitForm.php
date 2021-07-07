<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 13/09/19
 * Time: 15.04
 */

namespace akreditasi\models;


use common\models\Unit;
use yii\base\Model;

class PencarianUnitForm extends Model
{

    public $id_unit;

    private $_unit;

    public function rules()
    {
        return [
            ['id_unit','required'],
            ['id_unit','integer']
        ];
    }

    public function cari(){
        $this->_unit = Unit::findOne($this->id_unit);
        if(!$this->_unit) return null;

        $url = ['default/index','unit'=>$this->_unit->id];
        return $url;
    }
}