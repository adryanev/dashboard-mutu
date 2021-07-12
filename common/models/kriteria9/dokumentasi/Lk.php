<?php


namespace common\models\kriteria9\dokumentasi;


use yii\base\BaseObject;

class Lk extends BaseObject
{

    /** @var array | null */
    public $sumber;

    /** @var array | null */
    public $pendukung;

    /**
     * @return array|null
     */
    public function getSumber(): ?array
    {
        return $this->sumber;
    }

    /**
     * @param array|null $sumber
     */
    public function setSumber(?array $sumber): void
    {
        $this->sumber = $sumber;
    }

    /**
     * @return array|null
     */
    public function getPendukung(): ?array
    {
        return $this->pendukung;
    }

    /**
     * @param array|null $pendukung
     */
    public function setPendukung(?array $pendukung): void
    {
        $this->pendukung = $pendukung;
    }



}
