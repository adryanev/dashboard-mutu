<?php
/**
 * @var $this yii\web\View
 * @var $json common\models\kriteria9\led\Led
 * @var $kriteria [];
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
        <th>Kriteria</th>
        <th style="width: 110px"></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($json->butir as /** @var Led */
                   $kriteriaJson): ?>

        <tr>
            <th scope="row"><?= "C. " . Html::encode($kriteriaJson->nomor) ?></th>
            <td>
                <strong>Kriteria <?= Html::encode($kriteriaJson->nomor) ?>
                    : <?= $kriteria[$kriteriaJson->nomor - 1]->progress ?>%</strong><br>
                <?= $kriteriaJson->nama ?>
                <div class="kt-space-10"></div>
                <?=
                Progress::widget([
                    'percent' => $kriteria[$kriteriaJson->nomor - 1]->progress,
                    'barOptions' => ['class' => 'progress-bar-info m-progress-lg'],
                    'options' => ['class' => 'progress-sm']
                ]); ?>
            </td>
            <td style="padding-top: 15px;">
                <?= Html::a("<i class='la la-folder-open'></i>Lihat", [
                    $controller . '/' . $untuk . '-kriteria',
                    'led' => $led->id,
                    'kriteria' => $kriteriaJson->nomor,
                    'prodi' => $prodi->id
                ], ['class' => 'btn btn-default btn-pill btn-elevate btn-elevate-air']) ?>

                <!--                        <button type="button" class="btn btn-danger">Lihat</button>-->
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
