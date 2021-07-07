<?php
/**
 * @var $this yii\web\View
 * @var $akreditasiInstitusi common\models\kriteria9\akreditasi\K9AkreditasiInstitusi
 * @var $jsonEksternal common\models\kriteria9\penilaian\Penilaian
 * @var $jsonProfil common\models\kriteria9\penilaian\Penilaian
 * @var $jsonKriteria common\models\kriteria9\penilaian\Penilaian
 * @var $jsonAnalisis common\models\kriteria9\penilaian\Penilaian
 */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Penilaian Akreditasi Perguruan Tinggi';
?>
    <div class="kt-portlet">

        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h4 class="kt-port__head-title">
                    <?= $this->title ?>
                </h4>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div id="accordion" class="accordion accordion-toggle-plus accordion-solid">

                <div class="card">
                    <div class="card-header" id="heading-eksternal">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse-eksternal"
                             aria-expanded="false" aria-controls="collapse-eksternal">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="flaticon-file-2"></i> <?=
                                    $jsonEksternal->nomor ?>&nbsp;
                                    <small>&nbsp;<?= $jsonEksternal->judul ?> ( Skor: <?= $modelEksternal->total ?>
                                        )</small>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collapse-eksternal" class="collapse" aria-labelledby="heading-eksternal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php $formExternal = ActiveForm::begin(['id' => 'penilaian-kondisi-eksternal']) ?>
                                    <div class="table-responsive">

                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Indikator</th>
                                                <th>Penilaian</th>
                                                <th>Relasi</th>
                                                <th>Skor</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            echo '<tr>';

                                            echo '<td colspan="5">';
                                            echo '<h5>' . $jsonEksternal->nomor . '. ' . $jsonEksternal->judul . '</h5>';
                                            echo Html::button('Lihat LED', [
                                                'class' => 'btn btn-primary btn-elevate btn-elevate-air showModalButton',
                                                'title' => $jsonEksternal->nomor,
                                                'value' => Url::to([
                                                    'institusi/lihat-led-non-kriteria',
                                                    'akreditasi' => $akreditasiInstitusi->id,
                                                    'nomorLed' => $jsonEksternal->nomor,
                                                    'poin' => 'A'
                                                ])
                                            ]);
                                            echo '</td>';
                                            echo '</tr>';
                                            ?>

                                            <?php
                                            foreach ($jsonEksternal->indikators as $k => $indikator):
                                                $modelAttribute = \common\helpers\NomorKriteriaHelper::changeToDbFormat($indikator->nomor);
                                                $arrayGrade = [];
                                                if (!empty($indikator->_4)) {
                                                    $arrayGrade['4'] = 4;
                                                }
                                                if (!empty($indikator->_3)) {
                                                    $arrayGrade['3'] = 3;
                                                }
                                                if (!empty($indikator->_2)) {
                                                    $arrayGrade['2'] = 2;
                                                }
                                                if (!empty($indikator->_1)) {
                                                    $arrayGrade['1'] = 1;
                                                }
                                                if (!empty($indikator->_0)) {
                                                    $arrayGrade['0'] = 0;
                                                }
                                                ?>
                                                <tr>
                                                    <td><?= $indikator->nomor ?></td>
                                                    <td><?= $indikator->isi ?></td>
                                                    <td>
                                                        <?= empty($indikator->rumus) ? '' : '<p>' . nl2br($indikator->rumus) . '</p>' ?>
                                                        <?= empty($indikator->keterangan) ? '' : '<p>' . nl2br($indikator->keterangan) . '</p>' ?>
                                                        <?= empty($indikator->_4) ? '' : '<p><span
                                                                            class="text-success kt-font-bolder">4</span>. ' . nl2br($indikator->_4) . ' </p>' ?>

                                                        <?= empty($indikator->_3) ? '' : '<p><span
                                                                            class="text-info kt-font-bolder">3</span>. ' . nl2br($indikator->_3) . '</p>' ?>

                                                        <?= empty($indikator->_2) ? '' : '<p><span
                                                                            class="text-primary kt-font-bolder">2</span>. ' . nl2br($indikator->_2) . '</p>' ?>
                                                        <?= empty($indikator->_1) ? '' : '<p><span
                                                                            class="text-warning kt-font-bolder">1</span>. ' . nl2br($indikator->_1) . '</p>' ?>
                                                        <?= empty($indikator->_0) ? '' : '<p><span
                                                                            class="text-danger kt-font-bolder">0</span>. ' . nl2br($indikator->_0) . '</p>' ?></td>
                                                    <td>
                                                        <?php if (!empty($indikator->relasi)):
                                                            foreach ($indikator->relasi as $relasi):
                                                                ?>
                                                                <?= Html::button(
                                                                '<i class="fa fa-table"></i>Tabel ' . $relasi,
                                                                [
                                                                    'value' => Url::to([
                                                                        'lihat-lk',
                                                                        'akreditasi' => $akreditasiInstitusi->id,
                                                                        'tabel' => $relasi
                                                                    ]),
                                                                    'title' => 'Tabel ' . $relasi,
                                                                    'class' => 'btn btn-outline-warning btn-sm btn-elevate btn-elevate-air showModalButton'
                                                                ]
                                                            ) ?>
                                                            <?php
                                                            endforeach;
                                                        else:
                                                            echo 'Tidak Ada';
                                                        endif; ?>
                                                    </td>

                                                    <td><?= $formExternal->field($modelEksternal,
                                                            $modelAttribute)->radioList($arrayGrade)->label(false) ?></td>
                                                </tr>

                                            <?php endforeach;
                                            ?>
                                            </tbody>
                                        </table>

                                        <?= $formExternal->field($modelEksternal,
                                            'status')->dropDownList(\common\models\kriteria9\penilaian\institusi\K9PenilaianInstitusiEksternal::STATUS_PENILAIAN)->hint("Ubah status menjadi \"finish\" jika sudah selesai menilai.") ?>
                                        <?= Html::submitButton('<i class="fa fa-save"></i>Simpan',
                                            ['class' => 'btn btn-pill btn-primary btn-elevate btn-elevate-air pull-right']) ?>
                                    </div>

                                    <?php ActiveForm::end() ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="heading-profil">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse-profil"
                             aria-expanded="false" aria-controls="collapse-profil">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="flaticon-file-2"></i> <?=
                                    $jsonProfil->nomor ?>&nbsp;
                                    <small>&nbsp;<?= $jsonProfil->judul ?> ( Skor: <?= $modelProfil->total ?> )</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">


                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collapse-profil" class="collapse" aria-labelledby="heading-profil">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php $formProfil = ActiveForm::begin(['id' => 'penilaian-profil']) ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Indikator</th>
                                                <th>Penilaian</th>
                                                <th>Relasi</th>
                                                <th>Skor</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            echo '<tr>';

                                            echo '<td colspan="5">';
                                            echo '<h5>' . $jsonProfil->nomor . '. ' . $jsonProfil->judul . '</h5>';
                                            echo Html::button('Lihat LED', [
                                                'class' => 'btn btn-primary btn-elevate btn-elevate-air showModalButton',
                                                'title' => $jsonProfil->nomor,
                                                'value' => Url::to([
                                                    'institusi/lihat-led-non-kriteria',
                                                    'akreditasi' => $akreditasiInstitusi->id,
                                                    'nomorLed' => $jsonProfil->nomor,
                                                    'poin' => 'B'

                                                ])
                                            ]);
                                            echo '</td>';
                                            echo '</tr>';
                                            ?>
                                            <?php
                                            foreach ($jsonProfil->indikators as $k => $indikator):

                                                $modelAttribute = \common\helpers\NomorKriteriaHelper::changeToDbFormat($indikator->nomor);
                                                $arrayGrade = [];
                                                if (!empty($indikator->_4)) {
                                                    $arrayGrade['4'] = 4;
                                                }
                                                if (!empty($indikator->_3)) {
                                                    $arrayGrade['3'] = 3;
                                                }
                                                if (!empty($indikator->_2)) {
                                                    $arrayGrade['2'] = 2;
                                                }
                                                if (!empty($indikator->_1)) {
                                                    $arrayGrade['1'] = 1;
                                                }
                                                if (!empty($indikator->_0)) {
                                                    $arrayGrade['0'] = 0;
                                                }

                                                ?>
                                                <tr>
                                                    <td><?= $indikator->nomor ?></td>
                                                    <td><?= $indikator->isi ?></td>
                                                    <td>
                                                        <?= empty($indikator->rumus) ? '' : '<p>' . nl2br($indikator->rumus) . '</p>' ?>
                                                        <?= empty($indikator->keterangan) ? '' : '<p>' . nl2br($indikator->keterangan) . '</p>' ?>
                                                        <?= empty($indikator->_4) ? '' : '<p><span
                                                                            class="text-success kt-font-bolder">4</span>. ' . nl2br($indikator->_4) . ' </p>' ?>

                                                        <?= empty($indikator->_3) ? '' : '<p><span
                                                                            class="text-info kt-font-bolder">3</span>. ' . nl2br($indikator->_3) . '</p>' ?>

                                                        <?= empty($indikator->_2) ? '' : '<p><span
                                                                            class="text-primary kt-font-bolder">2</span>. ' . nl2br($indikator->_2) . '</p>' ?>
                                                        <?= empty($indikator->_1) ? '' : '<p><span
                                                                            class="text-warning kt-font-bolder">1</span>. ' . nl2br($indikator->_1) . '</p>' ?>
                                                        <?= empty($indikator->_0) ? '' : '<p><span
                                                                            class="text-danger kt-font-bolder">0</span>. ' . nl2br($indikator->_0) . '</p>' ?></td>
                                                    <td>
                                                        <?php if (!empty($indikator->relasi)):
                                                            foreach ($indikator->relasi as $relasi):
                                                                ?>
                                                                <?= Html::button(
                                                                '<i class="fa fa-table"></i>Tabel ' . $relasi,
                                                                [
                                                                    'value' => Url::to([
                                                                        'lihat-lk',
                                                                        'akreditasi' => $akreditasiInstitusi->id,
                                                                        'tabel' => $relasi
                                                                    ]),
                                                                    'title' => 'Tabel ' . $relasi,
                                                                    'class' => 'btn btn-outline-warning btn-sm btn-elevate btn-elevate-air showModalButton'
                                                                ]
                                                            ) ?>
                                                            <?php
                                                            endforeach;
                                                        else:
                                                            echo 'Tidak Ada';
                                                        endif; ?>
                                                    </td>

                                                    <td><?= $formProfil->field($modelProfil,
                                                            $modelAttribute)->radioList($arrayGrade)->label(false) ?></td>
                                                </tr>

                                            <?php endforeach;
                                            ?>
                                            </tbody>
                                        </table>
                                        <?= $formProfil->field($modelProfil,
                                            'status')->dropDownList(\common\models\kriteria9\penilaian\institusi\K9PenilaianInstitusiEksternal::STATUS_PENILAIAN)->hint("Ubah status menjadi \"finish\" jika sudah selesai menilai.") ?>
                                        <?= Html::submitButton('<i class="fa fa-save"></i>Simpan',
                                            ['class' => 'btn btn-pill btn-primary btn-elevate btn-elevate-air pull-right']) ?>
                                    </div>
                                    <?php ActiveForm::end() ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="heading-kriteria">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse-kriteria"
                             aria-expanded="false" aria-controls="collapse-kriteria">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="flaticon-file-2"></i> <?=
                                    $jsonKriteria->nomor ?>&nbsp;
                                    <small>&nbsp;<?= $jsonKriteria->judul ?> ( Skor: <?= $modelKriteria->total ?>
                                        )</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collapse-kriteria" class="collapse" aria-labelledby="heading-kriteria">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php $formKriteria = ActiveForm::begin(['id' => 'penilaian-kriteria']) ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Indikator</th>
                                                <th>Penilaian</th>
                                                <th>Relasi</th>
                                                <th>Skor</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($jsonKriteria->butir as $key1 => $butir1) {
                                                echo '<tr><td colspan="5"><h5>' . $butir1->nomor . '. ' . $butir1->judul . '</h5></td></tr>';

                                                foreach ($butir1->butir as $key2 => $butir2) {


                                                    if (!empty($butir2->butir)) {

                                                        foreach ($butir2->butir as $key3 => $butir3) {
                                                            echo '<tr>';

                                                            echo '<td colspan="5">';
                                                            echo '<h6>' . $butir3->nomor . '. ' . $butir3->judul . '</h6>';
                                                            echo Html::button('Lihat LED', [
                                                                'class' => 'btn btn-primary btn-elevate btn-elevate-air showModalButton',
                                                                'title' => $butir2->nomor,
                                                                'value' => Url::to([
                                                                    'institusi/lihat-led',
                                                                    'akreditasi' => $akreditasiInstitusi->id,
                                                                    'nomorLed' => $butir3->nomor
                                                                ])
                                                            ]);
                                                            echo '</td>';
                                                            echo '</tr>';
                                                            foreach ($butir3->indikators as $indikator):
                                                                $modelAttribute = \common\helpers\NomorKriteriaHelper::changeToDbFormat($indikator->nomor);
                                                                $arrayGrade = [];
                                                                if (!empty($indikator->_4)) {
                                                                    $arrayGrade['4'] = 4;
                                                                }
                                                                if (!empty($indikator->_3)) {
                                                                    $arrayGrade['3'] = 3;
                                                                }
                                                                if (!empty($indikator->_2)) {
                                                                    $arrayGrade['2'] = 2;
                                                                }
                                                                if (!empty($indikator->_1)) {
                                                                    $arrayGrade['1'] = 1;
                                                                }
                                                                if (!empty($indikator->_0)) {
                                                                    $arrayGrade['0'] = 0;
                                                                }

                                                                ?>
                                                                <tr>
                                                                    <td><?= $indikator->nomor ?></td>
                                                                    <td><?= $indikator->isi ?></td>
                                                                    <td>
                                                                        <?= empty($indikator->rumus) ? '' : '<p>' . nl2br($indikator->rumus) . '</p>' ?>
                                                                        <?= empty($indikator->keterangan) ? '' : '<p>' . nl2br($indikator->keterangan) . '</p>' ?>
                                                                        <?= empty($indikator->_4) ? '' : '<p><span
                                                                            class="text-success kt-font-bolder">4</span>. ' . nl2br($indikator->_4) . ' </p>' ?>

                                                                        <?= empty($indikator->_3) ? '' : '<p><span
                                                                            class="text-info kt-font-bolder">3</span>. ' . nl2br($indikator->_3) . '</p>' ?>

                                                                        <?= empty($indikator->_2) ? '' : '<p><span
                                                                            class="text-primary kt-font-bolder">2</span>. ' . nl2br($indikator->_2) . '</p>' ?>
                                                                        <?= empty($indikator->_1) ? '' : '<p><span
                                                                            class="text-warning kt-font-bolder">1</span>. ' . nl2br($indikator->_1) . '</p>' ?>
                                                                        <?= empty($indikator->_0) ? '' : '<p><span
                                                                            class="text-danger kt-font-bolder">0</span>. ' . nl2br($indikator->_0) . '</p>' ?></td>
                                                                    <td>
                                                                        <?php if (!empty($indikator->relasi)):
                                                                            foreach ($indikator->relasi as $relasi):
                                                                                ?>
                                                                                <?= Html::button(
                                                                                '<i class="fa fa-table"></i>Tabel ' . $relasi,
                                                                                [
                                                                                    'value' => Url::to([
                                                                                        'institusi/lihat-lk',

                                                                                        'akreditasi' => $akreditasiInstitusi->id,
                                                                                        'tabel' => $relasi

                                                                                    ]),
                                                                                    'title' => 'Tabel ' . $relasi,
                                                                                    'class' => 'btn btn-outline-warning btn-sm btn-elevate btn-elevate-air showModalButton'
                                                                                ]
                                                                            ) ?>
                                                                            <?php
                                                                            endforeach;
                                                                        else:
                                                                            echo 'Tidak Ada';
                                                                        endif; ?>
                                                                    </td>

                                                                    <td><?= $formKriteria->field($modelKriteria,
                                                                            $modelAttribute)->radioList($arrayGrade)->label(false) ?></td>
                                                                </tr>
                                                            <?php endforeach;
                                                        }
                                                    } else {
                                                        echo '<tr>';

                                                        echo '<td colspan="5">';
                                                        echo '<h6>' . $butir2->nomor . '. ' . $butir2->judul . '</h6>';
                                                        echo Html::button('Lihat LED', [
                                                            'class' => 'btn btn-primary btn-elevate btn-elevate-air showModalButton',
                                                            'title' => $butir2->nomor,
                                                            'value' => Url::to([
                                                                'institusi/lihat-led',
                                                                'akreditasi' => $akreditasiInstitusi->id,
                                                                'nomorLed' => $butir2->nomor
                                                            ])
                                                        ]);
                                                        echo '</td>';
                                                        echo '</tr>';
                                                        foreach ($butir2->indikators as $indikator):
                                                            $modelAttribute = \common\helpers\NomorKriteriaHelper::changeToDbFormat($indikator->nomor);
                                                            $arrayGrade = [];
                                                            if (!empty($indikator->_4)) {
                                                                $arrayGrade['4'] = 4;
                                                            }
                                                            if (!empty($indikator->_3)) {
                                                                $arrayGrade['3'] = 3;
                                                            }
                                                            if (!empty($indikator->_2)) {
                                                                $arrayGrade['2'] = 2;
                                                            }
                                                            if (!empty($indikator->_1)) {
                                                                $arrayGrade['1'] = 1;
                                                            }
                                                            if (!empty($indikator->_0)) {
                                                                $arrayGrade['0'] = 0;
                                                            }

                                                            ?>
                                                            <tr>
                                                                <td><?= $indikator->nomor ?></td>
                                                                <td><?= $indikator->isi ?></td>
                                                                <td>
                                                                    <?= empty($indikator->rumus) ? '' : '<p>' . nl2br($indikator->rumus) . '</p>' ?>
                                                                    <?= empty($indikator->keterangan) ? '' : '<p>' . nl2br($indikator->keterangan) . '</p>' ?>
                                                                    <?= empty($indikator->_4) ? '' : '<p><span
                                                                            class="text-success kt-font-bolder">4</span>. ' . nl2br($indikator->_4) . ' </p>' ?>

                                                                    <?= empty($indikator->_3) ? '' : '<p><span
                                                                            class="text-info kt-font-bolder">3</span>. ' . nl2br($indikator->_3) . '</p>' ?>

                                                                    <?= empty($indikator->_2) ? '' : '<p><span
                                                                            class="text-primary kt-font-bolder">2</span>. ' . nl2br($indikator->_2) . '</p>' ?>
                                                                    <?= empty($indikator->_1) ? '' : '<p><span
                                                                            class="text-warning kt-font-bolder">1</span>. ' . nl2br($indikator->_1) . '</p>' ?>
                                                                    <?= empty($indikator->_0) ? '' : '<p><span
                                                                            class="text-danger kt-font-bolder">0</span>. ' . nl2br($indikator->_0) . '</p>' ?></td>
                                                                <td>
                                                                    <?php if (!empty($indikator->relasi)):
                                                                        foreach ($indikator->relasi as $relasi):
                                                                            ?>
                                                                            <?= Html::button(
                                                                            '<i class="fa fa-table"></i>Tabel ' . $relasi,
                                                                            [
                                                                                'value' => Url::to([
                                                                                    'institusi/lihat-lk',
                                                                                    'akreditasi' => $akreditasiInstitusi->id,
                                                                                    'tabel' => $relasi
                                                                                ]),
                                                                                'title' => 'Tabel ' . $relasi,
                                                                                'class' => 'btn btn-outline-warning btn-sm btn-elevate btn-elevate-air showModalButton'
                                                                            ]
                                                                        ) ?>
                                                                        <?php
                                                                        endforeach;
                                                                    else:
                                                                        echo 'Tidak Ada';
                                                                    endif; ?>
                                                                </td>

                                                                <td><?= $formKriteria->field($modelKriteria,
                                                                        $modelAttribute)->radioList($arrayGrade)->label(false) ?></td>
                                                            </tr>
                                                        <?php endforeach;
                                                    }
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <?= $formKriteria->field($modelKriteria,
                                            'status')->dropDownList(\common\models\kriteria9\penilaian\institusi\K9PenilaianInstitusiEksternal::STATUS_PENILAIAN)->hint("Ubah status menjadi \"finish\" jika sudah selesai menilai.") ?>
                                        <?= Html::submitButton('<i class="fa fa-save"></i>Simpan',
                                            ['class' => 'btn btn-pill btn-primary btn-elevate btn-elevate-air pull-right']) ?>
                                    </div>
                                    <?php ActiveForm::end() ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="heading-analisis">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse-analisis"
                             aria-expanded="false" aria-controls="collapse-analisis">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="flaticon-file-2"></i> <?=
                                    $jsonAnalisis->nomor ?>&nbsp;

                                    <small>&nbsp;<?= $jsonAnalisis->judul ?> ( Skor: <?= $modelAnalisis->total ?>
                                        )</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collapse-analisis" class="collapse" aria-labelledby="heading-analisis">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <?php $formAnalisis = ActiveForm::begin(['id' => 'penilaian-analisis']); ?>
                                    <div class="table-responsive">

                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Indikator</th>
                                                <th>Penilaian</th>
                                                <th>Relasi</th>
                                                <th>Skor</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="5">
                                                    <h5><?=
                                                        $jsonAnalisis->nomor . '. ' . $jsonAnalisis->judul ?></h5>
                                                </td>
                                            </tr>
                                            <?php
                                            foreach ($jsonAnalisis->butir as $butir):
                                                echo '<tr>';

                                                echo '<td colspan="5">';
                                                echo '<h6>' . $butir->nomor . '. ' . $butir->judul . '</h6>';
                                                echo Html::button('Lihat LED', [
                                                    'class' => 'btn btn-primary btn-elevate btn-elevate-air showModalButton',
                                                    'title' => $butir->nomor,
                                                    'value' => Url::to([
                                                        'institusi/lihat-led-non-kriteria',
                                                        'akreditasi' => $akreditasiInstitusi->id,
                                                        'nomorLed' => $butir->nomor,
                                                        'poin' => 'D'

                                                    ])
                                                ]);
                                                echo '</td>';
                                                echo '</tr>';

                                                ?>

                                                <?php
                                                foreach ($butir->indikators as $k => $indikator):
                                                    $modelAttribute = \common\helpers\NomorKriteriaHelper::changeToDbFormat($indikator->nomor);
                                                    $arrayGrade = [];
                                                    if (!empty($indikator->_4)) {
                                                        $arrayGrade['4'] = 4;
                                                    }
                                                    if (!empty($indikator->_3)) {
                                                        $arrayGrade['3'] = 3;
                                                    }
                                                    if (!empty($indikator->_2)) {
                                                        $arrayGrade['2'] = 2;
                                                    }
                                                    if (!empty($indikator->_1)) {
                                                        $arrayGrade['1'] = 1;
                                                    }
                                                    if (!empty($indikator->_0)) {
                                                        $arrayGrade['0'] = 0;
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td><?= $indikator->nomor ?></td>
                                                        <td><?= $indikator->isi ?></td>
                                                        <td>
                                                            <?= empty($indikator->rumus) ? '' : '<p>' . nl2br($indikator->rumus) . '</p>' ?>
                                                            <?= empty($indikator->keterangan) ? '' : '<p>' . nl2br($indikator->keterangan) . '</p>' ?>
                                                            <?= empty($indikator->_4) ? '' : '<p><span
                                                                            class="text-success kt-font-bolder">4</span>. ' . nl2br($indikator->_4) . ' </p>' ?>

                                                            <?= empty($indikator->_3) ? '' : '<p><span
                                                                            class="text-info kt-font-bolder">3</span>. ' . nl2br($indikator->_3) . '</p>' ?>

                                                            <?= empty($indikator->_2) ? '' : '<p><span
                                                                            class="text-primary kt-font-bolder">2</span>. ' . nl2br($indikator->_2) . '</p>' ?>
                                                            <?= empty($indikator->_1) ? '' : '<p><span
                                                                            class="text-warning kt-font-bolder">1</span>. ' . nl2br($indikator->_1) . '</p>' ?>
                                                            <?= empty($indikator->_0) ? '' : '<p><span
                                                                            class="text-danger kt-font-bolder">0</span>. ' . nl2br($indikator->_0) . '</p>' ?></td>
                                                        <td>
                                                            <?php if (!empty($indikator->relasi)):
                                                                foreach ($indikator->relasi as $relasi):
                                                                    ?>
                                                                    <?= Html::button(
                                                                    '<i class="fa fa-table"></i>Tabel ' . $relasi,
                                                                    [
                                                                        'value' => Url::to([
                                                                            'lihat-lk',
                                                                            'akreditasi' => $akreditasiInstitusi->id,
                                                                            'tabel' => $relasi
                                                                        ]),
                                                                        'title' => 'Tabel ' . $relasi,
                                                                        'class' => 'btn btn-outline-warning btn-sm btn-elevate btn-elevate-air showModalButton'
                                                                    ]
                                                                ) ?>
                                                                <?php
                                                                endforeach;
                                                            else:
                                                                echo 'Tidak Ada';
                                                            endif; ?>
                                                        </td>

                                                        <td><?= $formAnalisis->field($modelAnalisis,
                                                                $modelAttribute)->radioList($arrayGrade)->label(false) ?></td>
                                                    </tr>

                                                <?php endforeach;
                                                ?>

                                            <?php endforeach;
                                            ?>


                                            </tbody>
                                        </table>
                                        <?= $formAnalisis->field($modelAnalisis,
                                            'status')->dropDownList(\common\models\kriteria9\penilaian\institusi\K9PenilaianInstitusiEksternal::STATUS_PENILAIAN)->hint("Ubah status menjadi \"finish\" jika sudah selesai menilai.") ?>
                                        <?= Html::submitButton('<i class="fa fa-save"></i>Simpan',
                                            ['class' => 'btn btn-pill btn-primary btn-elevate btn-elevate-air pull-right']) ?>

                                    </div>

                                    <?php ActiveForm::end() ?>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
<?php
$css = <<<CSS
@media (min-width: 992px) {
  .modal-dialog {
    max-width: 80%;
  }
}
CSS;
$this->registerCss($css);
