<?php


namespace common\models\kriteria9\dokumentasi;


use yii\base\BaseObject;

class Relasi extends BaseObject
{

    /** @var Led | null */
    public $led;

    /** @var Lk| null */
    public $lk;

    /**
     * @return Led
     */
    public function getLed(): ?Led
    {
        return $this->led;
    }

    /**
     * @param Led $led
     */
    public function setLed(?Led $led): void
    {
        $this->led = $led;
    }

    /**
     * @return Lk
     */
    public function getLk(): ?Lk
    {
        return $this->lk;
    }

    /**
     * @param Lk $lk
     */
    public function setLk(?Lk $lk): void
    {
        $this->lk = $lk;
    }


}
