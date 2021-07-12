<?php


namespace common\models\kriteria9\dokumentasi;


use yii\base\BaseObject;

class Dokumentasi extends BaseObject
{

    /** @var string */
    public $dokumen;

    /** @var Relasi */
    public $relasi;

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

    /**
     * @return Relasi
     */
    public function getRelasi(): Relasi
    {
        return $this->relasi;
    }

    /**
     * @param Relasi $relasi
     */
    public function setRelasi(Relasi $relasi): void
    {
        $this->relasi = $relasi;
    }



}
