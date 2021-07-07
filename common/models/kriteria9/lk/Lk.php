<?php


namespace common\models\kriteria9\lk;

use yii\base\BaseObject;

class Lk extends BaseObject
{

    /**
     * @var integer
     */
    public $kriteria;
    /**
     * @var string
     */
    public $judul;
    /**
     * @var TabelLk[]
     */
    public $butir;

    /**
     * @return int
     */
    public function getKriteria(): int
    {
        return $this->kriteria;
    }

    /**
     * @param int $kriteria
     */
    public function setKriteria(int $kriteria): void
    {
        $this->kriteria = $kriteria;
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
     * @return TabelLk[]
     */
    public function getButir(): array
    {
        return $this->butir;
    }

    /**
     * @param TabelLk[] $butir
     */
    public function setButir(array $butir): void
    {
        $this->butir = $butir;
    }
}
