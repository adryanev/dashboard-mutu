<?php
/**
 * @var $this yii\web\View
 */

use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>

<div class="form-kuantitatif">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'nama_dokumen')->textInput(['readonly' => true]) ?>
    <?= $form->field($modelUpload, 'berkas')->widget(FileInput::class, [
        'pluginOptions' => [
            'allowedFileExtensions' => ['xlsx', 'xls']
        ]
    ]) ?>
    <div class="pull-right">
        <?= Html::submitButton('<i class="la la-save"></i> Simpan',
            ['class' => 'btn btn-primary btn-pill btn-elevate btn-elevate-air']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
