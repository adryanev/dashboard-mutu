<?php
/**
 * @var $this yii\web\View
 * @var $lkCollection yii2mod\collection\Collection
 * @var $jenis string
 * @var $item common\models\kriteria9\lk\TabelLk
 */

use common\models\Constants;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

$jenisUc = \yii\helpers\StringHelper::mb_ucfirst($jenis);
$attr = 'dokumen_' . $jenis;
$controller = $this->context->id;
?>


<!--                            Tabel dokumen sumber-->
<table class="table">
    <thead class="thead-light">
    <tr>
        <th colspan="3" class="text-center">Dokumen <?= $jenisUc ?></th>
    </tr>
    </thead>
    <thead class="thead-dark">
    <tr>
        <th>Kode</th>
        <th colspan="2">Dokumen</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($item->$attr as $keyDoksum => $doksum) :

    $clear = trim($doksum->kode);
    $kodeSumber = '_' . str_replace('.', '_', $clear);

    if (!empty($doksum->kode)) : ?>

        <tr>
            <th scope="row"><?= $doksum->kode ?></th>
            <td>
                <p style="font-size: 14px;font-weight: 400"><?= $doksum->dokumen ?></p>
            </td>
            <td class="pull-right">

                <?php if ($untuk === 'isi'): ?>
                    <!--                                                    File-->
                    <?php Modal::begin([
                        'id' => 'upload-' . $kodeSumber,
                        'title' => 'Unggah Dokumen ' . $jenisUc . ' Laporan Kinerja',
                        'toggleButton' => [
                            'label' => '<i class="la la-upload"></i> &nbsp;Unggah',
                            'class' => 'btn btn-light btn-pill btn-elevate btn-elevate-air btn-sm pull-right'
                        ],
                        'size' => 'modal-lg',
                        'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                    ]); ?>

                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data'],
                        'action' => Url::to([
                            $controller . '/isi-kriteria',
                            'kriteria' => $kriteria,
                            'prodi' => $prodi->id,
                            'lk' => $lkProdi->id
                        ])
                    ]) ?>

                    <?= $form->field($dokUploadModel, 'jenisDokumen')->textInput([
                        'value' => $jenis,
                        'readonly' => true
                    ]) ?>
                    <?= $form->field($dokUploadModel, 'kodeDokumen')->textInput([
                        'value' => $doksum->kode,
                        'readonly' => true
                    ]) ?>
                    <?= $form->field($dokUploadModel, 'namaDokumen')->textInput() ?>

                    <?= $form->field($dokUploadModel, 'isiDokumen')->widget(FileInput::class, [
                        'options' => ['id' => 'isiDokumen' . $kodeSumber],
                        'pluginOptions' => [
                            'allowedFileExtensions' => Constants::ALLOWED_EXTENSIONS,
                        ]
                    ]) ?>

                    <div class="form-group text-right">
                        <?= Html::submitButton("<i class='la la-save'></i> Simpan",
                            ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-primary ']) ?>
                    </div>
                    <?php ActiveForm::end() ?>

                    <?php Modal::end(); ?>


                    <!--                                                    Text-->

                    <?php Modal::begin([
                        'id' => 'teks-' . $kodeSumber,
                        'title' => 'Isi Teks Dokumentasi',
                        'toggleButton' => [
                            'label' => '<i class="la la-file-text"></i> &nbsp;Teks',
                            'class' => 'btn btn-success btn-pill btn-sm btn-elevate btn-elevate-air pull-right'
                        ],
                        'size' => 'modal-lg',
                        'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                    ]); ?>

                    <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data'],
                    'action' => Url::to([
                        $controller . '/isi-kriteria',
                        'kriteria' => $kriteria,
                        'prodi' => $prodi->id,
                        'lk' => $lkProdi->id
                    ])
                ]) ?>

                    <?= $form->field($dokTextModel, 'jenisDokumen')->textInput([
                    'value' => $jenis,
                    'readonly' => true
                ]) ?>
                    <?= $form->field($dokTextModel, 'kodeDokumen')->textInput([
                    'value' => $doksum->kode,
                    'readonly' => true
                ]) ?>
                    <?= $form->field($dokTextModel, 'namaDokumen')->textInput() ?>

                    <?= $form->field($dokTextModel, 'isiDokumen')->widget(TinyMce::class, [
                    'options' => ['id' => 'sumber' . $kodeSumber],
                ])->label('Isi Dokumen') ?>

                    <div class="form-group text-right">
                        <?= Html::submitButton("<i class='la la-save'></i> Simpan",
                            ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-primary ']) ?>
                    </div>
                    <?php ActiveForm::end() ?>

                    <?php Modal::end(); ?>

                    <!--                                                    Link-->

                    <?php Modal::begin([
                        'id' => 'tautan-' . $kodeSumber,
                        'title' => 'Isi Tautan Dokumentasi',
                        'toggleButton' => [
                            'label' => '<i class="la la-link"></i> &nbsp;Tautan',
                            'class' => 'btn btn-info btn-pill btn-sm btn-elevate btn-elevate-air pull-right'
                        ],
                        'size' => 'modal-lg',
                        'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                    ]); ?>

                    <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data'],
                    'action' => Url::to([
                        $controller . '/isi-kriteria',
                        'kriteria' => $kriteria,
                        'prodi' => $prodi->id,
                        'lk' => $lkProdi->id
                    ])
                ]) ?>

                    <?= $form->field($dokLinkModel, 'jenisDokumen')->textInput([
                    'value' => $jenis,
                    'readonly' => true
                ]) ?>
                    <?= $form->field($dokLinkModel, 'kodeDokumen')->textInput([
                    'value' => $doksum->kode,
                    'readonly' => true
                ]) ?>
                    <?= $form->field($dokLinkModel, 'namaDokumen')->textInput() ?>
                    <?= $form->field($dokLinkModel, 'isiDokumen')->textInput([
                    '
                                                    placeholder' => 'https://www.contoh.com'
                ])->label('Tautan')->hint('https:// atau http:// harus dimasukkan.') ?>
                    <div class="form-group text-right">
                        <?= Html::submitButton("<i class='la la-save'></i> Simpan",
                            ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-primary ']) ?>
                    </div>
                    <?php ActiveForm::end() ?>

                    <?php Modal::end(); ?>
                    <?= Html::submitButton('<i class="flaticon2-laptop"></i> Gunakan Data', [
                        'value' => \yii\helpers\Url::to([
                            'resource/index',
                            'prodi' => $prodi->id,
                            'kriteria' => $kriteria,
                            'kode' => $doksum->kode,
                            'jenis' => Constants::LK,
                            'id_led_lk' => $lkProdi->id,
                            'jenis_dokumen' => $jenis
                        ]),
                        'title' => 'Gunakan Data Untuk : ' . $doksum->kode . '.' . ' ' . $doksum->dokumen,
                        'class' => 'btn btn-warning btn-pill btn-elevate btn-elevate-air showModalButton'
                    ]) ?>
                <?php endif ?>
            </td>
        </tr>


    <?php else :
        echo '<tr><td>Tidak ada dokumen</td></tr>';
    endif; ?>
    <?php


    $details = $lkCollection->where('kode_dokumen', $doksum->kode)->where('jenis_dokumen', $jenis)->values()->all();
    foreach ($details as $k => $v) : ?>

        <?= $this->render('_dokumen_item', [
            'path' => $path,
            'kriteria' => $kriteria,
            'v' => $v,
            'prodi' => $prodi,
            'lkProdi' => $lkProdi,
            'jenis' => $jenis,
            'untuk' => $untuk
        ]) ?>

    <?php
    endforeach;
    ?>

    </tbody>
    <?php endforeach; ?>
</table>
