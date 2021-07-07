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

use common\models\kriteria9\lk\prodi\K9LkProdiKriteria5Narasi;

class K9LkProdiNarasiKriteria5Form extends K9LkProdiKriteria5Narasi
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
        $this->lkProdiKriteria5->updateProgressNarasi()->save(false);
        $this->lkProdiKriteria5->lkProdi->updateProgress()->save(false);
        $this->lkProdiKriteria5->lkProdi->akreditasiProdi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }

    public function hitungNarasi()
    {
        $json = K9ProdiJsonHelper::getJsonKriteriaLk(5, $this->lkProdiKriteria5->lkProdi->akreditasiProdi->prodi->jenjang);
        $count = 0;

        $exclude = ['id', 'id_lk_prodi_kriteria5', 'progress', 'created_at', 'updated_at'];

        return $this->hitung($this, $exclude, $json);
    }
}
