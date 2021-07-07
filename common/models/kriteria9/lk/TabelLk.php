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
     * @var \common\models\kriteria9\Dokumen[]
     */
    public $dokumen_sumber;
    /**
     * @var \common\models\kriteria9\Dokumen[]
     */
    public $dokumen_pendukung;
}
