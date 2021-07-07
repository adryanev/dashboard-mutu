<?php
/**
 * @var $berkas common\models\Berkas[]
 * @var $prodi common\models\ProgramStudi
 * @var $kode string
 * @var $jenis string
 * @var $jenis_dokumen string
 * @var $id_led_lk int
 * @var $kriteria
 */

use kartik\grid\GridView;
use yii\widgets\ListView;

?>


<div class="berkas">
    <?= ListView::widget(['dataProvider' => $berkas,
        'itemView' => '_berkas_item',
        'summary' => false,
        'viewParams' => ['prodi'=>$prodi,'kode'=>$kode,'jenis'=>$jenis,'id_led_lk'=>$id_led_lk,'kriteria'=>$kriteria,'jenis_dokumen'=>$jenis_dokumen]])?>

</div>
