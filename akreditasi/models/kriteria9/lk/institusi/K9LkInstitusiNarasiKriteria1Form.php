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
use common\models\kriteria9\lk\institusi\K9LkInstitusiKriteria1Narasi;

class K9LkInstitusiNarasiKriteria1Form extends K9LkInstitusiKriteria1Narasi
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

    public function hitungNarasi()
    {

        $json = K9InstitusiJsonHelper::getJsonKriteriaLk(1);
        $exclude = ['id', 'id_lk_institusi_kriteria1', 'progress', 'created_at', 'updated_at'];

        return $this->hitung($this, $exclude, $json);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->lkInstitusiKriteria1->updateProgressNarasi()->save(false);
        $this->lkInstitusiKriteria1->lkInstitusi->updateProgress()->save(false);
        $this->lkInstitusiKriteria1->lkInstitusi->akreditasiInstitusi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }
}
