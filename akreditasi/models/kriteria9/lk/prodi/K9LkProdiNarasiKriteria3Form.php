<?php
/**
 * Project: kriteria.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/22/2019
 * Time: 5:29 PM
 */

namespace akreditasi\models\kriteria9\lk\prodi;

use common\helpers\HitungNarasiLkTrait;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\models\kriteria9\lk\prodi\K9LkProdiKriteria3Narasi;

class K9LkProdiNarasiKriteria3Form extends K9LkProdiKriteria3Narasi
{
    use HitungNarasiLkTrait;

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert) : bool
    {
        $this->progress = $this->hitungNarasi();
        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) : void
    {
        $this->lkProdiKriteria3->updateProgressNarasi()->save(false);
        $this->lkProdiKriteria3->lkProdi->updateProgress()->save(false);
        $this->lkProdiKriteria3->lkProdi->akreditasiProdi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }

    public function hitungNarasi(): float
    {
        $json = K9ProdiJsonHelper::getJsonKriteriaLk(3, $this->lkProdiKriteria3->lkProdi->akreditasiProdi->prodi->jenjang);
        $exclude = ['id', 'id_lk_prodi_kriteria3', 'progress', 'created_at', 'updated_at'];

        return $this->hitung($this, $exclude, $json);
    }
}
