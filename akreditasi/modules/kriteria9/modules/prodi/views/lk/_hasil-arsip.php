<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 8/26/2019
 * Time: 11:36 AM
 */

/**
 * @var $lk K9LkProdi
 * @var $url array
 */

use common\models\kriteria9\lk\prodi\K9LkProdi;
use common\models\standar7\dokumentasi\prodi\S7DokumentasiProdi;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Hasil Pencarian
            </h3>
        </div>
    </div>


    <div class="kt-portlet__body">
        <div class="kt-section kt-section--first" style="margin-bottom: 0;">

            <?php if (!$lk) : echo "Tidak ada Data"; else: ?>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Akreditasi</th>
                        <th>Tahun</th>
                        <th>Link</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td><?= $lk->akreditasiProdi->akreditasi->nama?></td>
                        <td><?= $lk->akreditasiProdi->akreditasi->tahun ?></td>
                        <td><?= Html::a('<i class="la la-folder"></i> Lihat', $url, ['class' => ['btn btn-default btn-pill btn-elevate btn-elevate-air']]) ?></td>
                    </tr>

                    </tbody>
                </table>

            <?php endif; ?>

        </div>
    </div>
</div>

