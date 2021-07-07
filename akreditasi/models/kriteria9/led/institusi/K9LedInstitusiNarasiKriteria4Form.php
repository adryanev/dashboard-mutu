<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class K9LedInstitusiNarasiKriteria4Form
 * @package akreditasi\models\kriteria9\led\institusi
 */


namespace akreditasi\models\kriteria9\led\institusi;

use common\helpers\HitungNarasiLedTrait;
use common\models\kriteria9\led\institusi\K9LedInstitusiNarasiKriteria4;

class K9LedInstitusiNarasiKriteria4Form extends K9LedInstitusiNarasiKriteria4
{

    use HitungNarasiLedTrait;

    public function beforeSave($insert)
    {
        $this->progress =  $this->updateProgress();

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->ledInstitusiKriteria4->updateProgress();
        $this->ledInstitusiKriteria4->ledInstitusi->updateProgress();
        $this->ledInstitusiKriteria4->ledInstitusi->akreditasiInstitusi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }

    public function updateProgress()
    {
        $exclude = ['id','id_led_prodi_kriteria4','progress','created_at','updated_at','created_by','updated_by'];
        return $this->hitung($this, $exclude);
    }
}
