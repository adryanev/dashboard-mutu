<?php

use common\models\User;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 *  @var $dataProdi []
 *  @var $dataUnit []
 *  @var $dataRoles []
 *  @var $tipe []
 */

?>



<div class="create_user_form">

    <?php $form = ActiveForm::begin([
            'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'id' => 'create-user-form'
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['prompt'=>'username']) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList([User::STATUS_ACTIVE => 'Aktif', User::STATUS_INACTIVE => 'Tidak Aktif'], ['prompt' => 'Pilih Status User']) ?>
    <?= $form->field($model, 'hak_akses')->dropDownList( $dataRoles,['prompt'=>'Pilih Hak Akses']) ?>

    <?= $form->field($model, 'nama_lengkap')->textInput() ?>

    <?=$form->field($model,'tipe')->widget(Select2::class,[
        'data' => $tipe,
        'options' => [
            'id' => 'tipe',
        ],
        'pluginOptions' => [
            'placeholder'=>'Pilih Tipe Akun',
            'allowClear'=>true
        ]
    ])?>


    <?= $form->field($model, 'id_prodi',[ 'options'=>['class'=>'d-none form-group']])->widget(Select2::class, [
        'data' => $dataProdi,
        'options' => [
            'id'=>'id_prodi',
            'class'=>'hidden'
        ],
        'pluginOptions' => [
            'placeholder' => 'Pilih Program Studi',
        ]
    ]) ?>
    <?= $form->field($model,'id_unit',[ 'options'=>['class'=>'d-none form-group']])->widget(Select2::class,[
        'data' => $dataUnit,

        'options' => [
            'id'=>'id_unit',

        ],
        'pluginOptions' => [
            'placeholder'=>'Pilih Unit / Lembaga / Satker',
        ]
    ])->label('Unit / Lembaga / Satker')?>

    <div class="form-group">
        <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- create_user_form -->

<?php
$jsForm = <<<JS
$('#tipe').on('change', function() {
        if(this.value === 'programStudi'){
            $("#id_prodi").parent().removeClass("d-none");
            $("#id_unit").parent().addClass("d-none");
        }
        if(this.value==='unit'){
             $("#id_prodi").parent().addClass("d-none");
            $("#id_unit").parent().removeClass("d-none");
        }
    });
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
