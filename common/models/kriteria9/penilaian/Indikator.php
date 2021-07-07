<?php


namespace common\models\kriteria9\penilaian;

use yii\base\BaseObject;

class Indikator extends BaseObject
{

    /**
     * @var string | null
     */
    public $nomor;

    /**
     * @var array | null
     */
    public $relasi;

    /**
     * @var string | null
     */
    public $rumus;

    /**
     * @var string | null
     */
    public $isi;

    /**
     * @var string | null
     */
    public $_4;

    /**
     * @var string | null
     */
    public $_3;

    /**
     * @var string | null
     */
    public $_2;

    /**
     * @var string | null
     */
    public $_1;

    /**
     * @var string | null
     */
    public $_0;

    /**
     * @var string | null
     */
    public $keterangan;

    /**
     * @return string|null
     */
    public function getNomor(): ?string
    {
        return $this->nomor;
    }

    /**
     * @param string|null $nomor
     */
    public function setNomor(?string $nomor): void
    {
        $this->nomor = $nomor;
    }

    /**
     * @return array|null
     */
    public function getRelasi(): ?array
    {
        return $this->relasi;
    }

    /**
     * @param array|null $relasi
     */
    public function setRelasi(?array $relasi): void
    {
        $this->relasi = $relasi;
    }

    /**
     * @return string|null
     */
    public function getRumus(): ?string
    {
        return $this->rumus;
    }

    /**
     * @param string|null $rumus
     */
    public function setRumus(?string $rumus): void
    {
        $this->rumus = $rumus;
    }

    /**
     * @return string|null
     */
    public function getIsi(): ?string
    {
        return $this->isi;
    }

    /**
     * @param string|null $isi
     */
    public function setIsi(?string $isi): void
    {
        $this->isi = $isi;
    }

    /**
     * @return string|null
     */
    public function get4(): ?string
    {
        return $this->_4;
    }

    /**
     * @param string|null $_4
     */
    public function set4(?string $_4)
    {
        $this->_4 = $_4;
    }

    /**
     * @return string|null
     */
    public function get3(): ?string
    {
        return $this->_3;
    }

    /**
     * @param string|null $_3
     */
    public function set3(?string $_3)
    {
        $this->_3 = $_3;
    }


    /**
     * @return string|null
     */
    public function get2(): ?string
    {
        return $this->_2;
    }

    /**
     * @param string|null $_2
     */
    public function set2(?string $_2)
    {
        $this->_2 = $_2;
    }

    /**
     * @return string|null
     */
    public function get1(): ?string
    {
        return $this->_1;
    }

    /**
     * @param string|null $_1
     */
    public function set1(?string $_1)
    {
        $this->_1 = $_1;
    }

    /**
     * @return string|null
     */
    public function get0(): ?string
    {
        return $this->_0;
    }

    /**
     * @param string|null $_0
     */
    public function set0(?string $_0)
    {
        $this->_0 = $_0;
    }

    /**
     * @return string|null
     */
    public function getKeterangan(): ?string
    {
        return $this->keterangan;
    }

    /**
     * @param string|null $keterangan
     */
    public function setKeterangan(?string $keterangan): void
    {
        $this->keterangan = $keterangan;
    }
}
