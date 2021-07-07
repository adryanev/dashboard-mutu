<?php

use common\models\ProgramStudi;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\datecontrol\Module;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\sertifikat\SertifikatProdi */
/* @var $form yii\bootstrap4\ActiveForm;
*/
/* @var $dataProdi ProgramStudi */
?>


<div class="sertifikat-prodi-form">

    <?php $form = ActiveForm::begin(['id'=>'sertifikat-prodi-form']); ?>

    <?= $form->field($model, 'id_prodi')->widget(Select2::class, [
        'data' => $dataProdi,
        'options' => [
            'placeholder' => 'Pilih Program Studi'
        ]
    ])->label('Program Studi')

    ?>

    <?= $form->field($model, 'nama_lembaga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_akreditasi')->widget(DateControl::class,[
        'type' => Module::FORMAT_DATE,
        'widgetOptions' => [
            'pluginOptions'=>['autoclose'=>true]
        ]
    ])
    ?>

    <?= $form->field($model, 'tgl_kadaluarsa')->widget(DateControl::class,[
        'type' => Module::FORMAT_DATE,
        'widgetOptions' => [
            'pluginOptions'=>['autoclose'=>true]
        ]
    ])

    ?>

    <?= $form->field($model, 'nomor_sk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_sertifikat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai_angka')->textInput() ?>

    <?= $form->field($model, 'nilai_huruf')->widget(Select2::class,[
        'data'=>['A'=>'A','B'=>'B','C'=>'C'],
        'options' => [
            'placeholder' => 'Pilih Nilai Huruf'
        ]
    ])->label('Nilai Huruf') ?>

    <?= $form->field($model, 'tahun_sk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_pengajuan')->widget(DateControl::class,[
        'type' => Module::FORMAT_DATE,
        'widgetOptions' => [
            'pluginOptions'=>['autoclose'=>true]
        ]
    ])

    ?>

    <?= $form->field($model, 'tanggal_diterima')->widget(DateControl::class,[
        'type' => Module::FORMAT_DATE,
        'widgetOptions' => [
            'pluginOptions'=>['autoclose'=>true]
        ]
    ])

    ?>

    <?= $form->field($model, 'is_publik')->widget(Select2::class, [
        'data' => [1 => 'Publik', 0=>'Tidak Publik'],
        'options' => [
            'placeholder' => 'Pilih Keterangan Dokumen'
        ]
    ])->label('Keterangan Dokumen') ?>

    <?= $form->field($model, 'dokumen_sk')->widget(FileInput::class,[
        'options' => ['id'=>'dokumen1'],
        'pluginOptions' => [
            'showUpload'=>false
        ]
    ])?>

    <?= $form->field($model, 'sertifikat')->widget(FileInput::class,[
        'options' => ['id'=>'dokumen2'],
        'pluginOptions' => [
            'showUpload'=>false
        ]
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $js = <<<JS
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

        KTApp.blockPage({
            overlayColor: '#000000',
            type: 'v2',
            state: 'primary',
            message: 'Sedang memproses...'
        });

    });

JS;

$this->registerJs($js);
?>