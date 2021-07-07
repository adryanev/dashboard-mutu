<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\kriteria9\akreditasi\K9AkreditasiProdi */
/* @var $form yii\bootstrap4\ActiveForm; */
/* @var $dataAkreditasi [] */
/* @var $dataProdi []*/
?>


<div class="k9-akreditasi-prodi-form">

    <?php $form = ActiveForm::begin(['id' => 'akreditasi-prodi-form']); ?>

    <?=    $form->field($model, 'id_akreditasi')->widget(Select2::class,
        ['data' => $dataAkreditasi,
            'options' => ['placeholder' => 'Pilih Akreditasi']])->label('Akreditasi') ?>

    <?= $form->field($model, 'id_prodi')->widget(Select2::class, [
        'data' => $dataProdi,
        'options' => [
            'placeholder' => 'Pilih Program Studi'
        ]
    ])->label('Program Studi') ?>


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