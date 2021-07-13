<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProfilInstitusi */
/* @var $form yii\bootstrap4\ActiveForm;
 */
?>


    <div class="profil-institusi-form">

        <?php $form = ActiveForm::begin(['id' => 'profil-institusi-form']); ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'isi')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan',
                ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
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
