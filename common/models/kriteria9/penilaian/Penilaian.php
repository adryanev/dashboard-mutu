<?php
namespace common\models\kriteria9\penilaian;

use yii\base\BaseObject;

class Penilaian extends BaseObject
{

    /**
     * @var string
     */
    public $nomor;

    /**
     * @var string
     */
    public $judul;

    /**
     * @var Penilaian[] | null
     */
    public $butir;

    /**
     * @var Indikator[] | null
     */
    public $indikators;

    /**
     * @return string
     */
    public function getNomor(): string
    {
        return $this->nomor;
    }

    /**
     * @param string $nomor
     */
    public function setNomor(string $nomor): void
    {
        $this->nomor = $nomor;
    }

    /**
     * @return string
     */
    public function getJudul(): string
    {
        return $this->judul;
    }

    /**
     * @param string $judul
     */
    public function setJudul(string $judul): void
    {
        $this->judul = $judul;
    }

    /**
     * @return Penilaian[]|null
     */
    public function getButir(): ?array
    {
        return $this->butir;
    }

    /**
     * @param Penilaian[]|null $butir
     */
    public function setButir(?array $butir): void
    {
        $this->butir = $butir;
    }

    /**
     * @return Indikator[]|null
     */
    public function getIndikators(): ?array
    {
        return $this->indikators;
    }

    /**
     * @param Indikator[]|null $indikators
     */
    public function setIndikators(?array $indikators): void
    {
        $this->indikators = $indikators;
    }




}
