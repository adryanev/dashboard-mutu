<?php
/**
 * @var $this yii\web\View
 * @var $led common\models\kriteria9\led\prodi\K9LedProdi
 */

use yii\bootstrap4\Html;
use yii\helpers\StringHelper;

?>


<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Form
                LED <?= Html::encode(StringHelper::mb_ucfirst($led->akreditasiProdi->akreditasi->jenis_akreditasi)) ?>
            </h3>
        </div>
    </div>

    <div class="kt-portlet__body">
        <div class="kt-section kt-section--first" style="margin-bottom: 0;">

            <table class="table table-striped">

                <tbody>
                <tr>
                    <th scope="row">Laporan Evaluasi Diri</th>
                    <td>Akreditasi Program Studi</td>
                </tr>
                <tr>
                    <th scope="row">Lembaga Akreditasi</th>
                    <td><?= Html::encode($led->akreditasiProdi->akreditasi->lembaga) ?></td>
                </tr>
                <tr>
                    <th scope="row">Tahun Akreditasi</th>
                    <td><?= Html::encode($led->akreditasiProdi->akreditasi->tahun) ?></td>
                </tr>
                <tr>
                    <th scope="row">Jenis Akreditasi</th>
                    <td><?= Html::encode(StringHelper::mb_ucfirst($led->akreditasiProdi->akreditasi->jenis_akreditasi)) ?></td>
                </tr>
                <tr>
                    <th scope="row">LED Untuk</th>
                    <td>Program Studi</td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

