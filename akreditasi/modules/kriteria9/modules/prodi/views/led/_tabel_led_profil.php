<?php
/**
 * @var $this yii\web\View
 * @var $json_profil common\models\kriteria9\led\Led
 * @var $modelProfil common\models\kriteria9\led\prodi\K9LedProdiNarasiProfilUpps
 * @var $prodi common\models\ProgramStudi
 * @var $untuk string
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
        <th scope="row"><?= Html::encode($json_profil->nomor) ?></th>
        <td>
            <strong><?= $json_profil->nama ?>
                : <?= $modelProfil->progress ?>%</strong><br>
            <div class="kt-space-10"></div>
            <?=
            Progress::widget([
                'percent' => $modelProfil->progress,
                'barOptions' => ['class' => 'progress-bar-info m-progress-lg'],
                'options' => ['class' => 'progress-sm']
            ]); ?>
        </td>
        <td style="padding-top: 15px;">
            <?= Html::a("<i class='la la-folder-open'></i>Lihat", [
                $controller . '/' . $untuk . '-non-kriteria',
                'led' => $led->id,
                'prodi' => $prodi->id,
                'poin' => $json_profil->nomor
            ], ['class' => 'btn btn-default btn-pill btn-elevate btn-elevate-air']) ?>

            <!--                        <button type="button" class="btn btn-danger">Lihat</button>-->
        </td>
    </tr>
    </tbody>
</table>
