<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\kriteria9\dokumentasi\prodi\DokumentasiProdi
 */

use yii\bootstrap4\ActiveForm;

?>

<div class="comments-form">
    <?php $form = ActiveForm::begin() ?>

    <?=$form->field($model,'komentar')->textInput()?>

    <div class="form-group pull-right">
        <?= \yii\bootstrap4\Html::submitButton('<i class="la la-save"></i> Simpan',['class'=>'btn btn-primary
        btn-pill btn-elevate btn-elevate-air'])?>
    </div>
    <?php ActiveForm::end() ?>
</div>
