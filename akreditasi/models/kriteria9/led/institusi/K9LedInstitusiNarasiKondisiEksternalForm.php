<?php


namespace akreditasi\models\kriteria9\led\institusi;


use common\helpers\HitungNarasiLedTrait;
use common\models\kriteria9\led\institusi\K9LedInstitusiNarasiKondisiEksternal;

class K9LedInstitusiNarasiKondisiEksternalForm extends K9LedInstitusiNarasiKondisiEksternal
{
    use HitungNarasiLedTrait;

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->progress = $this->upgradeProgress();
        return parent::beforeSave($insert);
    }

    /**
     * @return float
     */
    private function upgradeProgress()
    {
        $exclude = ['id', 'id_led_institusi', 'progress', 'created_at', 'updated_at'];
        return $this->hitung($this, $exclude);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->ledInstitusi->updateProgress();
        $this->ledInstitusi->akreditasiInstitusi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }


}
