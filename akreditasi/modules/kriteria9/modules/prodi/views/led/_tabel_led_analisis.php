<?php
/**
 * @var $this yii\web\View
 * @var $json_analisis common\models\kriteria9\led\Led
 * @var $modelAnalisis common\models\kriteria9\led\prodi\K9LedProdiNarasiAnalisis
 * @var $untuk string
 * @var $prodi common\models\ProgramStudi
 */

use yii\bootstrap4\Html;
use yii\bootstrap4\Progress;

$controller = $this->context->id;
?>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th style="width:10%">No.</th>
        <th>Poin</th>
        <th style="width: 110px"></th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <th><?= Html::encode($json_analisis->nomor) ?></th>
        <td>
            <strong><?= $json_analisis->nama ?>
                : <?= $modelAnalisis->progress ?>%</strong><br>
            <div class="kt-space-10"></div>
            <?=
            Progress::widget([
                'percent' => $modelAnalisis->progress,
                'barOptions' => ['class' => 'progress-bar-info m-progress-lg'],
                'options' => ['class' => 'progress-sm']
            ]); ?>
        </td>
        <td style="padding-top: 15px;">
            <?= Html::a("<i class='la la-folder-open'></i>Lihat", [
                $controller . '/' . $untuk . '-non-kriteria',
                'led' => $led->id,
                'prodi' => $prodi->id,
                'poin' => $json_analisis->nomor
            ], ['class' => 'btn btn-default btn-pill btn-elevate btn-elevate-air']) ?>

            <!--                        <button type="button" class="btn btn-danger">Lihat</button>-->
        </td>
    </tr>
    </tbody>
</table>
