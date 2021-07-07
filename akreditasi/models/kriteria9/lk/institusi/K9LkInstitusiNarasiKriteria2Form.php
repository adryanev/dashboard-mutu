<?php
/**
 * Project: kriteria.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/22/2019
 * Time: 5:29 PM
 */

namespace akreditasi\models\kriteria9\lk\institusi;


use common\helpers\HitungNarasiLkTrait;
use common\helpers\kriteria9\K9InstitusiJsonHelper;
use common\helpers\kriteria9\K9InstitusiProgressHelper;
use common\models\kriteria9\lk\institusi\K9LkInstitusiKriteria2Narasi;

class K9LkInstitusiNarasiKriteria2Form extends K9LkInstitusiKriteria2Narasi
{
    use HitungNarasiLkTrait;

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->progress = $this->hitungNarasi();

        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->lkInstitusiKriteria2->updateProgressNarasi()->save(false);
        $this->lkInstitusiKriteria2->lkInstitusi->updateProgress()->save(false);
        $this->lkInstitusiKriteria2->lkInstitusi->akreditasiInstitusi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }

    public function hitungNarasi()
    {
        $json = K9InstitusiJsonHelper::getJsonKriteriaLk(2);
        $exclude = ['id', 'id_lk_institusi_kriteria2', 'progress', 'created_at', 'updated_at'];

        return $this->hitung($this, $exclude, $json);
    }
}
