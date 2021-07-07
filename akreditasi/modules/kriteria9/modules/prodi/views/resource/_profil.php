<?php
/**
 * @var $profil Profil
 */

use common\models\Profil;
use supplyhog\ClipboardJs\ClipboardJsWidget;
?>

<div class="table-responsive">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Isi</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Visi</td>
                <td id=<?="{$profil->type}-visi}"?>><?=strip_tags($profil->visi)?></td>
                <td><?= ClipboardJsWidget::widget([
                    'inputId' => "{$profil->type}-visi}",
                    'text' => strip_tags($profil->visi),
                        'label' => '<i class="flaticon2-copy"></i> Salin',
                        'successText' =>'Berhasil di salin',
                        'tag' => 'button',
                        'htmlOptions' => ['class'=>'btn btn-dark btn-pill btn-elevate btn-elevate-air']

                    ])?></td>

            </tr>
            <tr>
                <td>2</td>
                <td>Misi</td>
                <td><?=strip_tags($profil->misi)?></td>
                <td><?= ClipboardJsWidget::widget([
                        'text' => strip_tags($profil->misi),
                        'label' => '<i class="flaticon2-copy"></i> Salin',
                        'successText' =>'Berhasil di salin',
                        'tag' => 'button',
                        'htmlOptions' => ['class'=>'btn btn-dark btn-pill btn-elevate btn-elevate-air']

                    ])?></td>

            </tr>
            <tr>
                <td>3</td>
                <td>Tujuan</td>
                <td><?=strip_tags($profil->tujuan)?></td>
                <td><?= ClipboardJsWidget::widget([
                        'text' => strip_tags($profil->tujuan),
                        'label' => '<i class="flaticon2-copy"></i> Salin',
                        'successText' =>'Berhasil di salin',
                        'tag' => 'button',
                        'htmlOptions' => ['class'=>'btn btn-dark btn-pill btn-elevate btn-elevate-air']

                    ])?></td>

            </tr>
            <tr>
                <td>4</td>
                <td>Sasaran</td>
                <td><?=strip_tags($profil->sasaran)?></td>
                <td><?= ClipboardJsWidget::widget([
                        'text' => strip_tags($profil->sasaran),
                        'label' => '<i class="flaticon2-copy"></i> Salin',
                        'successText' =>'Berhasil di salin',
                        'tag' => 'button',
                        'htmlOptions' => ['class'=>'btn btn-dark btn-pill btn-elevate btn-elevate-air']

                    ])?></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Motto</td>
                <td><?=strip_tags($profil->motto)?></td>
                <td><?= ClipboardJsWidget::widget([
                        'text' => strip_tags($profil->motto),
                        'label' => '<i class="flaticon2-copy"></i> Salin',
                        'successText' =>'Berhasil di salin',
                        'tag' => 'button',
                        'htmlOptions' => ['class'=>'btn btn-dark btn-pill btn-elevate btn-elevate-air']

                    ])?></td>
            </tr>
            <tr>
                <td>6</td>
                <td>Sambutan</td>
                <td><?=strip_tags($profil->sambutan)?></td>
                <td><?= ClipboardJsWidget::widget([
                        'text' => strip_tags($profil->sambutan),
                        'label' => '<i class="flaticon2-copy"></i> Salin',
                        'successText' =>'Berhasil di salin',
                        'tag' => 'button',
                        'htmlOptions' => ['class'=>'btn btn-dark btn-pill btn-elevate btn-elevate-air']

                    ])?></td>
            </tr>
            <tr>
                <!-- TODO: Tambahkan tombol gunakan struktur organisasi. Copy gambarnya terus update di database -->
                <td>7</td>
                <td>Struktur Organisasi</td>
                <td><?=$profil->struktur_organisasi?></td>
                <td></td>
            </tr>

        </tbody>
    </table>
</div>
