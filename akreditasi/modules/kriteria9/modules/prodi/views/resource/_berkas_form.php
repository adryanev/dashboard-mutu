<?php
/**
 * @var $this yii\web\View
 * @var $model akreditasi\models\kriteria9\forms\resource\ResourceProdiForm
 * @var $detail common\models\DetailBerkas
 * @var $prodi integer
 */

use common\models\Constants;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

?>

<div class="resource-prodi-form">
    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'id')->hiddenInput(['readonly' => true])->label(false) ?>
    <?= $form->field($model, 'nama')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'jenis')->widget(Select2::class, [
        'data' => [Constants::LED=>'Laporan Evaluasi Diri', Constants::LK=>'Laporan Kinerja'],
        'options' => ['id'=>'jenis-' . $model->id],
        'pluginOptions' => [
            'placeholder'=>'Pilih Jenis Tujuan',

        ]
    ])?>
    <?=$form->field($model, 'tujuan')->widget(DepDrop::class, [
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'depends'=>'jenis-' . $model->id,
            'url'=> Url::to(['resource/populate-led-lk','id_prodi'=>$prodi]),

        ]
    ])?>

    <?= Html::submitButton('Simpan', ['class'=>'btn btn-primary btn-elevate btn-elevate-air'])?>
    <?php ActiveForm::end() ?>
</div>
