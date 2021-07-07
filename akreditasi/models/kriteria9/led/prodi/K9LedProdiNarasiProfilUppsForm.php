<?php


namespace akreditasi\models\kriteria9\led\prodi;


use common\models\kriteria9\led\prodi\K9LedProdiNarasiKondisiEksternal;
use common\models\kriteria9\led\prodi\K9LedProdiNarasiProfilUpps;

class K9LedProdiNarasiProfilUppsForm extends K9LedProdiNarasiProfilUpps
{

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {

            $this->progress = $this->updateProgress();

        return parent::beforeSave($insert);
    }

    /**
     * @return float
     */
    public function updateProgress()
    {
        $exclude = ['id', 'id_led_prodi', 'progress', 'created_at', 'updated_at'];
        return $this->hitung($this, $exclude);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
            $this->ledProdi->updateProgress();
            $this->ledProdi->akreditasiProdi->updateProgress()->save(false);
        parent::afterSave($insert, $changedAttributes);
    }
}
