<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\models\ProgramStudiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-studi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jurusan_departemen') ?>

    <?= $form->field($model, 'id_fakultas_akademi') ?>

    <?php // echo $form->field($model, 'nomor_sk_pendirian') ?>

    <?php // echo $form->field($model, 'tanggal_sk_pendirian') ?>

    <?php // echo $form->field($model, 'pejabat_ttd_sk_pendirian') ?>

    <?php // echo $form->field($model, 'bulan_berdiri') ?>

    <?php // echo $form->field($model, 'tahun_berdiri') ?>

    <?php // echo $form->field($model, 'nomor_sk_operasional') ?>

    <?php // echo $form->field($model, 'tanggal_sk_operasional') ?>

    <?php // echo $form->field($model, 'peringkat_banpt_terakhir') ?>

    <?php // echo $form->field($model, 'nilai_banpt_terakhir') ?>

    <?php // echo $form->field($model, 'nomor_sk_banpt') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'kodepos') ?>

    <?php // echo $form->field($model, 'nomor_telp') ?>

    <?php // echo $form->field($model, 'homepage') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'kaprodi') ?>

    <?php // echo $form->field($model, 'jenjang') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
