<?php

/**
 * @var $kegiatan common\models\unit\KegiatanUnit[]
 * @var $prodi common\models\ProgramStudi
 * @var $kode string
 * @var $jenis string
 * @var $jenis_dokumen string
 * @var $id_led_lk int
 * @var $kriteria
 */

use yii\widgets\ListView; ?>
<div class="kegiatan">
    <?= ListView::widget(['dataProvider' => $kegiatan,
        'itemView' => '_kegiatan_item',
        'summary' => false,
        'viewParams' => ['prodi'=>$prodi,'kode'=>$kode,'jenis'=>$jenis,'id_led_lk'=>$id_led_lk,'kriteria'=>$kriteria,'jenis_dokumen'=>$jenis_dokumen]])?>

</div>
