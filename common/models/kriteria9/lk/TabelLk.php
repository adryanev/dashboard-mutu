<?php


namespace common\models\kriteria9\lk;

use yii\base\BaseObject;

/**
 * Class TabelLk
 * @package common\models\kriteria9\lk
 */
class TabelLk extends BaseObject
{

    /**
     * @var string
     */
    public $tabel;
    /**
     * @var string
     */
    public $isi;
    /**
     * @var string
     */
    public $nama;
    /**
     * @var string
     */
    public $petunjuk;
    /**
     * @var string
     */
    public $keterangan;
    /**
     * @var string
     */
    public $template;
    /**
     * @var \common\models\kriteria9\Dokumen[] | null
     */
    public $dokumen_sumber;
    /**
     * @var \common\models\kriteria9\Dokumen[] | null
     */
    public $dokumen_pendukung;

    /**
     * @return string
     */
    public function getTabel(): string
    {
        return $this->tabel;
    }

    /**
     * @param string $tabel
     */
    public function setTabel(string $tabel): void
    {
        $this->tabel = $tabel;
    }

    /**
     * @return string
     */
    public function getIsi(): string
    {
        return $this->isi;
    }

    /**
     * @param string $isi
     */
    public function setIsi(string $isi): void
    {
        $this->isi = $isi;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @param string $nama
     */
    public function setNama(string $nama): void
    {
        $this->nama = $nama;
    }

    /**
     * @return string
     */
    public function getPetunjuk(): string
    {
        return $this->petunjuk;
    }

    /**
     * @param string $petunjuk
     */
    public function setPetunjuk(string $petunjuk): void
    {
        $this->petunjuk = $petunjuk;
    }

    /**
     * @return string
     */
    public function getKeterangan(): string
    {
        return $this->keterangan;
    }

    /**
     * @param string $keterangan
     */
    public function setKeterangan(string $keterangan): void
    {
        $this->keterangan = $keterangan;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

    /**
     * @return \common\models\kriteria9\Dokumen[]|null
     */
    public function getDokumenSumber(): ?array
    {
        return $this->dokumen_sumber;
    }

    /**
     * @param \common\models\kriteria9\Dokumen[]|null $dokumen_sumber
     */
    public function setDokumenSumber(?array $dokumen_sumber): void
    {
        $this->dokumen_sumber = $dokumen_sumber;
    }

    /**
     * @return \common\models\kriteria9\Dokumen[]|null
     */
    public function getDokumenPendukung(): ?array
    {
        return $this->dokumen_pendukung;
    }

    /**
     * @param \common\models\kriteria9\Dokumen[]|null $dokumen_pendukung
     */
    public function setDokumenPendukung(?array $dokumen_pendukung): void
    {
        $this->dokumen_pendukung = $dokumen_pendukung;
    }


}
