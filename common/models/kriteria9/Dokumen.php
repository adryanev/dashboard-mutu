<?php

namespace common\models\kriteria9;

use yii\base\BaseObject;

class Dokumen extends BaseObject
{
    /** @var $kode string */
    public $kode;

    /** @var $dokumen string */
    public $dokumen;

    /**
     * @return string
     */
    public function getKode(): string
    {
        return $this->kode;
    }

    /**
     * @param string $kode
     */
    public function setKode(string $kode): void
    {
        $this->kode = $kode;
    }

    /**
     * @return string
     */
    public function getDokumen(): string
    {
        return $this->dokumen;
    }

    /**
     * @param string $dokumen
     */
    public function setDokumen(string $dokumen): void
    {
        $this->dokumen = $dokumen;
    }


}
