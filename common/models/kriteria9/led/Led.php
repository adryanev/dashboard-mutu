<?php
namespace common\models\kriteria9\led;

use common\models\kriteria9\Dokumen;
use yii\base\BaseObject;

class Led extends BaseObject
{

    /**
     * @var string|null
     */
    public $nomor;


    /**
     * @var string|null
     */
    public $nama;

    /**
     * @var string|null
     */
    public $deskripsi;

    /**
     * @var boolean
     */
    public $writeable;

    /**
     * @var Led[]|null
     */
    public $butir;

    /**
     * @var Dokumen[]|null
     */
    public $dokumen_sumber;

    /**
     * @var Dokumen[]|null
     */
    public $dokumen_pendukung;


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
     * @return string|null
     */
    public function getNama(): ?string
    {
        return $this->nama;
    }

    /**
     * @param string|null $nama
     */
    public function setNama(?string $nama): void
    {
        $this->nama = $nama;
    }

    /**
     * @return string|null
     */
    public function getDeskripsi(): ?string
    {
        return $this->deskripsi;
    }

    /**
     * @param string|null $deskripsi
     */
    public function setDeskripsi(?string $deskripsi): void
    {
        $this->deskripsi = $deskripsi;
    }

    /**
     * @return bool
     */
    public function isWriteable(): bool
    {
        return $this->writeable;
    }

    /**
     * @param bool $writeable
     */
    public function setWriteable(bool $writeable): void
    {
        $this->writeable = $writeable;
    }

    /**
     * @return Led[]|null
     */
    public function getButir(): ?array
    {
        return $this->butir;
    }

    /**
     * @param Led[]|null $butir
     */
    public function setButir(?array $butir): void
    {
        $this->butir = $butir;
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
