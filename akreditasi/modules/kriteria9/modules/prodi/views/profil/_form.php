<?php

use kartik\datecontrol\DateControl;
use kartik\datecontrol\Module;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProgramStudi */
/* @var $form yii\bootstrap4\ActiveForm */
?>


<div class="program-studi-form">

    <?php $form = ActiveForm::begin(['enableClientScript' => true, 'id' => 'prodi-form']); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'kaprodi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'jurusan_departemen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenjang')->widget(Select2::class, [
        'data'=>\common\models\ProgramStudi::JENJANG,
        'options' => ['class'=>'kt-select2 disabled-input','placeholder'=>'Pilih Jenjang'],
        'pluginEvents' => [
        "select2:opening" => "function() { $('.disabled-input').attr('disabled', true); }",
        ],
    ])->label('Jenjang') ?>



    <?= $form->field($model, 'nomor_sk_pendirian')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tanggal_sk_pendirian')->widget(DateControl::class, [
            'type' => Module::FORMAT_DATE,
            'widgetOptions' => [
                'pluginOptions'=>['autoclose'=>true]
            ]
        ]) ?>
    <?= $form->field($model, 'pejabat_ttd_sk_pendirian')->textInput(['maxlength' => true])
    ->label('Nama Pejabat TTD SK Pendirian') ?>
    <?= $form->field($model, 'bulan_berdiri')->widget(DateControl::class, [
            'type' => Module::FORMAT_DATE,
            'widgetOptions' => [
                'pluginOptions'=>['autoclose'=>true]
            ]
        ])->label("Berdiri") ?>
    <?= $form->field($model, 'tahun_berdiri')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nomor_sk_operasional')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tanggal_sk_operasional')->widget(DateControl::class, [
            'type' => Module::FORMAT_DATE,
            'widgetOptions' => [
                'pluginOptions'=>['autoclose'=>true]
            ]
        ]) ?>
    <?= $form->field($model, 'peringkat_banpt_terakhir')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nilai_banpt_terakhir')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nomor_sk_banpt')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'kodepos')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nomor_telp')->textInput(['type'=>'number']) ?>
    <?= $form->field($model, 'homepage')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand block-ui']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$jsForm = <<<JS
 $('form').on('beforeSubmit', function()
    {
        var form = $(this);
        //console.log('before submit');

        var submit = form.find(':submit');
        KTApp.block('.modal',{
            overlayColor: '#000000',
            type: 'v2',
            state: 'primary',
            message: 'Sedang Memproses...'
        });
        submit.html('<i class="flaticon2-refresh"></i> Sedang Memproses');
        submit.prop('disabled', true);

    });

JS;

$this->registerJs($jsForm);
?>
