<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class K9LedInstitusiNarasiKriteria7Form
 * @package akreditasi\models\kriteria9\led\institusi
 */


namespace akreditasi\models\kriteria9\led\institusi;

use common\helpers\HitungNarasiLedTrait;
use common\models\kriteria9\led\institusi\K9LedInstitusiNarasiKriteria7;

class K9LedInstitusiNarasiKriteria7Form extends K9LedInstitusiNarasiKriteria7
{

    use HitungNarasiLedTrait;

    public function beforeSave($insert)
    {
        $this->progress =  $this->updateProgress();

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->ledInstitusiKriteria7->updateProgress();
        $this->ledInstitusiKriteria7->ledInstitusi->updateProgress();
        $this->ledInstitusiKriteria7->ledInstitusi->akreditasiInstitusi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }

    public function updateProgress()
    {
        $exclude = ['id','id_led_prodi_kriteria7','progress','created_at','updated_at','created_by','updated_by'];
        return $this->hitung($this, $exclude);
    }
}
