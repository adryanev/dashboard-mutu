<?php
/**
 * @var $this yii\web\View
 * @var $jenis string
 * @var $json_dokumen common\models\kriteria9\Dokumen[]
 * @var $kriteria
 * @var $linkModel akreditasi\models\kriteria9\forms\led\K9DetailLedProdiLinkForm
 * @var $textModel akreditasi\models\kriteria9\forms\led\K9DetailLedProdiTeksForm
 * @var $detailModel \akreditasi\models\kriteria9\forms\led\K9DetailLedProdiUploadForm
 * @var $path string
 * @var $model
 * @var $prodi
 * @var $detailCollection yii2mod\collection\Collection
 */

use common\models\Constants;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

$controller = $this->context->id;
$attr = 'dokumen_' . $jenis
?>
<!--                            Tabel dokumen sumber-->
<table class="table table-striped table-hover">
    <thead class="thead-light">
    <tr>
        <th colspan="3" class="text-center">Dokumen <?= ucfirst($jenis) ?></th>
    </tr>
    </thead>
    <thead class="thead-dark">
    <tr>
        <th>Kode</th>
        <th colspan="2">Nama Dokumen</th>
    </tr>
    </thead>

    <tbody>
    <?php
    if (!empty($json_dokumen)):
        foreach ($json_dokumen as $keyDok => $dok):
            $dokAttr = \common\helpers\NomorKriteriaHelper::changeToDbFormat($dok->kode);
            ?>
            <tr>
                <th scope="row">
                    <?= $dok->kode ?>
                </th>
                <td>
                    <?= $dok->dokumen ?>
                </td>
                <td>
                    <div class="row pull-right">
                        <div class="col-lg-12">
                            <?php if ($untuk === 'isi'): ?>
                                <?php Modal::begin([
                                    'id' => 'text-' . $jenis . '-' . $dokAttr,
                                    'title' => "Dokumen $jenis Led",
                                    'toggleButton' => [
                                        'label' => '<i class="la la-file-text"></i> &nbsp;Teks',
                                        'class' => 'btn btn-success btn-sm btn-pill btn-elevate btn-elevate-air pull-right'
                                    ],
                                    'size' => 'modal-lg',
                                    'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                                ]) ?>
                                <?php $form = ActiveForm::begin([
                                    'action' => \yii\helpers\Url::to([
                                        $controller . '/isi-kriteria',
                                        'led' => $model->id,
                                        'prodi' => $prodi,
                                        'kriteria' => $kriteria
                                    ]),
                                    'options' => ['enctype' => 'multipart/form-data'],
                                    'id' => $dokAttr . "-text-$jenis-form"
                                ]) ?>

                                <?= $form->field($textModel, 'kode_dokumen')->textInput([
                                    'value' => $dok->kode,
                                    'readonly' => true
                                ]) ?>
                                <?= $form->field($textModel, 'jenis_dokumen')->textInput([
                                    'value' => $jenis,
                                    'readonly' => true
                                ]) ?>
                                <?= $form->field($textModel, 'nama_dokumen')->textInput()->label('Nama Teks') ?>
                                <?= $form->field($textModel, 'berkasDokumen')->widget(TinyMce::class, [
                                    'options' => ['id' => $dokAttr . "-text-$jenis-input",],


                                ])->label('Teks') ?>

                                <div class="form-group pull-right">
                                    <?= Html::submitButton('<i class="la la-save"></i> Simpan',
                                        ['class' => 'btn btn-primary btn-pill btn-elevate btn-elevate-air']) ?>
                                </div>
                                <?php ActiveForm::end() ?>

                                <?php Modal::end() ?>
                                <?php Modal::begin([
                                'id' => 'tautan-' . $jenis . '-' . $dokAttr,
                                'title' => "Dokumen $jenis Led",
                                'toggleButton' => [
                                    'label' => '<i class="la la-link"></i> &nbsp;Tautan',
                                    'class' => 'btn btn-info btn-sm btn-pill btn-elevate btn-elevate-air pull-right'
                                ],
                                'size' => 'modal-lg',
                                'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                            ]) ?>
                                <?php $form = ActiveForm::begin([
                                'action' => \yii\helpers\Url::to([
                                    $controller . '/isi-kriteria',
                                    'led' => $model->id,
                                    'prodi' => $prodi,
                                    'kriteria' => $kriteria
                                ]),
                                'options' => ['enctype' => 'multipart/form-data'],
                                'id' => $dokAttr . "-link-$jenis-form"
                            ]) ?>

                                <?= $form->field($linkModel, 'kode_dokumen')->textInput([
                                'value' => $dok->kode,
                                'readonly' => true
                            ]) ?>
                                <?= $form->field($linkModel, 'jenis_dokumen')->textInput([
                                'value' => $jenis,
                                'readonly' => true
                            ]) ?>
                                <?= $form->field($linkModel, 'nama_dokumen')->textInput()->label('Nama Tautan') ?>
                                <?= $form->field($linkModel, 'berkasDokumen')->textInput([
                                '
                                                    placeholder' => 'https://www.contoh.com'
                            ])->label('Tautan')->hint('https:// atau http:// harus dimasukkan.') ?>

                                <div class="form-group pull-right">
                                    <?= Html::submitButton('<i class="la la-save"></i> Simpan',
                                        ['class' => 'btn btn-primary btn-pill btn-elevate btn-elevate-air']) ?>
                                </div>
                                <?php ActiveForm::end() ?>

                                <?php Modal::end() ?>
                                <?php Modal::begin([
                                'id' => 'upload-' . $jenis . '-' . $dokAttr,
                                'title' => "Upload Dokumen $jenis Led",
                                'toggleButton' => [
                                    'label' => '<i class="la la-upload"></i> &nbsp;Unggah',
                                    'class' => 'btn btn-light btn-sm btn-pill btn-elevate btn-elevate-air pull-right'
                                ],
                                'size' => 'modal-lg',
                                'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                            ]) ?>
                                <?php $form = ActiveForm::begin([
                                'action' => \yii\helpers\Url::to([
                                    $controller . '/isi-kriteria',
                                    'led' => $model->id,
                                    'prodi' => $prodi,
                                    'kriteria' => $kriteria
                                ]),
                                'options' => ['enctype' => 'multipart/form-data'],
                                'id' => $dokAttr . "-upload-$jenis-form"
                            ]) ?>

                                <?= $form->field($detailModel, 'kode_dokumen')->textInput([
                                'value' => $dok->kode,
                                'readonly' => true
                            ]) ?>
                                <?= $form->field($detailModel, 'nama_dokumen')->textInput([
                                'value' => $dok->dokumen,
                                'readonly' => true
                            ]) ?>
                                <?= $form->field($detailModel, 'jenis_dokumen')->textInput([
                                'value' => $jenis,
                                'readonly' => true
                            ]) ?>
                                <?= $form->field($detailModel, 'berkasDokumen')->widget(FileInput::class, [
                                'options' => ['id' => "dokumen-$jenis" . $dokAttr],
                                'pluginOptions' => [
                                    'allowedFileExtensions' => Constants::ALLOWED_EXTENSIONS,
                                ]
                            ]) ?>

                                <div class="form-group pull-right">
                                    <?= Html::submitButton('<i class="la la-save"></i> Simpan',
                                        ['class' => 'btn btn-primary btn-pill btn-elevate btn-elevate-air']) ?>
                                </div>
                                <?php ActiveForm::end() ?>

                                <?php Modal::end() ?>
                                <?= Html::submitButton('<i class="flaticon2-laptop"></i> Gunakan Data', [
                                    'value' => \yii\helpers\Url::to([
                                        'resource/index',
                                        'prodi' => $_GET['prodi'],
                                        'kriteria' => $kriteria,
                                        'kode' => $dok->kode,
                                        'jenis' => Constants::LED,
                                        'id_led_lk' => $_GET['led'],
                                        'jenis_dokumen' => $jenis
                                    ]),
                                    'title' => 'Gunakan Data Untuk : ' . $dok->kode . '.' . ' ' . $dok->dokumen,
                                    'class' => 'btn btn-warning btn-pill btn-elevate btn-elevate-air showModalButton'
                                ]) ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </td>
            </tr>
            <?php

            $detail = $detailCollection->where('jenis_dokumen', $jenis)->where('kode_dokumen',
                $dok->kode)->values()->all();

            foreach ($detail as $k => $v):
                ?>
                <?= $this->render('@akreditasi/modules/kriteria9/modules/prodi/views/led/_item_dokumen_detail', [
                'path' => $path,
                'kriteria' => $kriteria,
                'jenis' => $jenis,
                'detail' => $v,
                'nomor' => $k + 1,
                'prodi' => $prodi,
                'untuk' => $untuk,
                'model' => $model
            ]) ?>

            <?php endforeach; ?>
        <?php endforeach;
    else:
        ?>
        <tr>
            <td colspan="3">Tidak ada dokumen</td>
        </tr>
    <?php
    endif; ?>


    </tbody>
</table>
