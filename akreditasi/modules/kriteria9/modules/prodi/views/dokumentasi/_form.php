<?php
/**
 * @var $this yii\web\View
 * @var $model yii\base\Model
 * @var $jenis
 *
 */

use common\models\Constants;
use dosamigos\tinymce\TinyMce;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>

<div class="form-dokumentasi">
    <?php $form = ActiveForm::begin()?>

    <?=$form->field($model,'nama_dokumen')->textInput(['value'=>$model->nama_dokumen,'readonly'=>true])?>
    <?php
    if($jenis === Constants::LINK):
    ?>
        <?= $form->field($model, 'berkasDokumen')->textInput([
        'placeholder' => 'https://www.contoh.com'
    ])->label('Tautan')->hint('https:// atau http:// harus dimasukkan.') ?>

    <?php
    elseif ($jenis === \common\helpers\FileTypeHelper::TYPE_STATIC_TEXT):
    ?>
        <?= $form->field($model, 'berkasDokumen')->widget(TinyMce::class)->label('Teks') ?>
    <?php
    else:
    ?>
    <?=$form->field($model,'berkasDokumen')->widget(\kartik\file\FileInput::class,[
        'pluginOptions' => [
            'allowedFileExtensions' => Constants::ALLOWED_EXTENSIONS,
        ]
    ])?>

    <?php endif?>

    <div class="form-group">
        <?= Html::submitButton('<i class="la la-save"></i> Simpan',['class'=>'btn btn-primary
        btn-pill btn-elevate btn-elevate-air'])?>
    </div>

    <?php ActiveForm::end()?>
</div>
