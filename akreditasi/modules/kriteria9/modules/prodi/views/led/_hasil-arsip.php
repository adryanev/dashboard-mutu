<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 8/26/2019
 * Time: 11:36 AM
 */

/**
 * @var $led K9LedProdi
 * @var $url array
 */

use common\models\kriteria9\led\prodi\K9LedProdi;
use yii\bootstrap4\Html;

?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Hasil Pencarian
                <h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="kt-section kt-section--first" style="margin-bottom: 0;">

            <?php if (!$led) : echo "Tidak ada Data"; else: ?>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Akreditasi</th>
                        <th>Tahun</th>
                        <th>Lembaga</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td><?= $led->akreditasiProdi->akreditasi->nama ?></td>
                        <td><?= $led->akreditasiProdi->akreditasi->tahun ?></td>
                        <td><?= $led->akreditasiProdi->akreditasi->lembaga ?></td>
                        <td><?= Html::a('<i class="la la-folder"></i> Lihat', $url, ['class' => ['btn btn-default btn-pill btn-elevate btn-elevate-air']]) ?></td>
                    </tr>

                    </tbody>
                </table>

            <?php endif; ?>

        </div>
    </div>

    <!--end::Form-->
</div>

