<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class K9LedProdiNarasiKriteria2Form
 * @package akreditasi\models\kriteria9\led\prodi
 */


namespace akreditasi\models\kriteria9\led\prodi;

use common\helpers\HitungNarasiLedTrait;
use common\models\kriteria9\led\prodi\K9LedProdiNarasiKriteria2;

class K9LedProdiNarasiKriteria2Form extends K9LedProdiNarasiKriteria2
{

    use HitungNarasiLedTrait;

    public function beforeSave($insert)
    {
        $this->progress =  $this->updateProgress();

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->ledProdiKriteria2->updateProgress();
        $this->ledProdiKriteria2->ledProdi->updateProgress();
        $this->ledProdiKriteria2->ledProdi->akreditasiProdi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }

    public function updateProgress()
    {
        $exclude = ['id','id_led_prodi_kriteria2','progress','created_at','updated_at','created_by','updated_by'];
        return $this->hitung($this, $exclude);
    }
}
