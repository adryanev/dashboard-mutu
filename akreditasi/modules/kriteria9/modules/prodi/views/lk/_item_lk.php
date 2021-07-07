<?php
/**
 * @var $this yii\web\View
 * @var $untuk string
 * @var $modelAttribute
 * @var $modelNarasi
 * @var $item
 * @var $dokMO
 */

use common\models\Constants;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

$controller = $this->context->id;
?>
<div class="lk-content">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'id' => $modelAttribute . '-form',
                'action' => [
                    $controller . '/isi-kriteria',
                    'lk' => $lkProdi->id,
                    'kriteria' => $kriteria,
                    'prodi' => $prodi->id
                ]
            ]) ?>

            <h5>Tabel <?= $item->tabel ?> <?= $item->nama ?></h5>
            <p><?= $item->petunjuk ?></p>

            <?php if ($untuk === 'isi'): ?>
                <?= $form->field($modelNarasi, $modelAttribute)->widget(TinyMce::class, [
                    'options' => ['id' => $modelAttribute . '-tinymce-kriteria'],
                ])->label('') ?>
                <div class="form-group pull-right">
                    <?= Html::submitButton('<i class="la la-save"></i> Simpan',
                        ['class' => 'btn btn-primary btn-pill btn-elevate btn-elevate-air ']) ?>
                </div>
            <?php else: ?>
                <?= $modelNarasi->$modelAttribute ?>
            <?php endif ?>

            <?php if (!empty($item->keterangan)): ?>
                <h6>Keterangan</h6>
                <?= $item->keterangan ?>
            <?php endif; ?>

            <?php ActiveForm::end() ?>

        </div>
    </div>


    <?= $this->render('_dokumen', [
        'lkProdi' => $lkProdi,
        'prodi' => $prodi,
        'item' => $item,
        'path' => $path,
        'dokUploadModel' => $dokUploadModel,
        'dokTextModel' => $dokTextModel,
        'dokLinkModel' => $dokLinkModel,
        'kriteria' => $kriteria,
        'jenis' => Constants::SUMBER,
        'lkCollection' => $lkCollection,
        'untuk' => $untuk
    ]) ?>
    <?= $this->render('_dokumen', [
        'lkProdi' => $lkProdi,
        'prodi' => $prodi,
        'item' => $item,
        'path' => $path,
        'dokUploadModel' => $dokUploadModel,
        'dokTextModel' => $dokTextModel,
        'dokLinkModel' => $dokLinkModel,
        'kriteria' => $kriteria,
        'jenis' => Constants::PENDUKUNG,
        'lkCollection' => $lkCollection,
        'untuk' => $untuk
    ]) ?>

    <!--                                Tabel dokumen lainnya-->
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th colspan="2" class="text-left">Dokumen Lainnya</th>
            <th>
                <?php if ($untuk === 'isi'): ?>
                    <?php Modal::begin([
                        'id' => 'upload-' . $item->tabel,
                        'title' => 'Unggah Dokumen Lainnya',
                        'toggleButton' => [
                            'label' => '<i class="la la-upload"></i> &nbsp;Unggah',
                            'class' => 'btn btn-light btn-pill btn-elevate btn-elevate-air pull-right'
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
                        'value' => Constants::LAINNYA,
                        'readonly' => true
                    ]) ?>
                    <?= $form->field($dokUploadModel, 'kodeDokumen')->textInput([
                        'value' => $item->tabel,
                        'readonly' => true
                    ]) ?>
                    <?= $form->field($dokUploadModel, 'namaDokumen')->textInput() ?>

                    <?= $form->field($dokUploadModel, 'isiDokumen')->widget(FileInput::class, [
                        'options' => ['id' => 'isiDokumenLainnya' . str_replace('.', '_', $item->tabel)],
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
                        'id' => 'teks-' . $item->tabel,
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
                    'value' => Constants::LAINNYA,
                    'readonly' => true
                ]) ?>
                    <?= $form->field($dokTextModel, 'kodeDokumen')->textInput([
                    'value' => $item->tabel,
                    'readonly' => true
                ]) ?>
                    <?= $form->field($dokTextModel, 'namaDokumen')->textInput() ?>

                    <?= $form->field($dokTextModel, 'isiDokumen')->widget(TinyMce::class, [
                    'options' => ['id' => 'lainnya-isi_teks'],
                ])->label('Isi Dokumen') ?>

                    <div class="form-group text-right">
                        <?= Html::submitButton("<i class='la la-save'></i> Simpan",
                            ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-primary ']) ?>
                    </div>
                    <?php ActiveForm::end() ?>

                    <?php Modal::end(); ?>

                    <!--                                                    Link-->

                    <?php Modal::begin([
                        'id' => 'tautan-' . $item->tabel,
                        'title' => 'Isi Tautan Dokumen Lainnya',
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
                    'value' => Constants::LAINNYA,
                    'readonly' => true
                ]) ?>
                    <?= $form->field($dokLinkModel, 'kodeDokumen')->textInput([
                    'value' => $item->tabel,
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
                        'value' => Url::to([
                            'resource/index',
                            'prodi' => $prodi->id,
                            'kriteria' => $kriteria,
                            'kode' => '',
                            'jenis' => Constants::LK,
                            'id_led_lk' => $lkProdi->id,
                            'jenis_dokumen' => Constants::LAINNYA
                        ]),
                        'title' => 'Gunakan Data Untuk Dokumen lainnya ',
                        'class' => 'btn btn-warning btn-pill btn-elevate btn-elevate-air showModalButton pull-right'
                    ]) ?>
                <?php endif ?>
            </th>
        </tr>
        </thead>
        <thead class="thead-dark">
        <tr>
            <th>No.</th>
            <th colspan="2">Dokumen</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $details = $lkCollection->where('jenis_dokumen', Constants::LAINNYA)->where('kode_dokumen',
            $item->tabel)->values()->all();

        if (!empty($details)) :
            foreach ($details as $k => $v) :?>
                <?= $this->render('_dokumen_item', [
                    'path' => $path,
                    'kriteria' => $kriteria,
                    'v' => $v,
                    'prodi' => $prodi,
                    'lkProdi' => $lkProdi,
                    'jenis' => Constants::LAINNYA,
                    'untuk' => $untuk
                ]) ?>
            <?php
            endforeach;
        else:
            echo '<tr><td>Tidak ada dokumen</td></tr>';
        endif ?>
        </tbody>
    </table>

</div>

