<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FakultasAkademi */
/* @var $form yii\widgets\ActiveForm */
/* @var $jenis array */
?>


<div class="fakultas-akademi-form">

    <?php $form = ActiveForm::begin(['options' => ['id'=>'fakultas-form']]); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dekan')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'jenis')->widget(\kartik\select2\Select2::class,[

            'data' => $jenis,
        'pluginOptions' => [
                'placeholder'=>'Pilih Jenis'
        ]
    ])?>

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