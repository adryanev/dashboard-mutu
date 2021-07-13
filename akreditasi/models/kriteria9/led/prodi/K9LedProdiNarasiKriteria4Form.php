<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class K9LedProdiNarasiKriteria4Form
 * @package akreditasi\models\kriteria9\led\prodi
 */


namespace akreditasi\models\kriteria9\led\prodi;


use common\helpers\HitungNarasiLedTrait;
use common\models\kriteria9\led\prodi\K9LedProdiNarasiKriteria4;

class K9LedProdiNarasiKriteria4Form extends K9LedProdiNarasiKriteria4
{

    use HitungNarasiLedTrait;

    public function beforeSave($insert)
    {
        $this->progress =  $this->updateProgress();

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->ledProdiKriteria4->updateProgress();
        $this->ledProdiKriteria4->ledProdi->updateProgress();
        $this->ledProdiKriteria4->ledProdi->akreditasiProdi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }

    public function updateProgress()
    {
        $exclude = ['id','id_led_prodi_kriteria4','progress','created_at','updated_at','created_by','updated_by'];
        return $this->hitung($this, $exclude);
    }
}
