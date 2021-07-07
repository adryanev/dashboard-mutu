<?php

use common\models\ProgramStudi;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $dataProdi ProgramStudi */


$this->title = "Pencarian Akreditas Program Studi";

$this->params['breadcrumbs'][] = ['label' => 'Beranda', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<!--card-->

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Form Pencarian Akreditasi Program Studi
            </h3>
        </div>
    </div>

    <!--begin::Form-->

    <div class="kt-portlet__body">

        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'akreditasi')->widget(Select2::class, [
            'data' => $dataAkreditasi,
            'options' => [
                'placeholder' => 'Pilih Akreditasi'
            ]
        ]) ?>

        <?= $form->field($model, 'prodi')->widget(Select2::class, [
            'data' => $dataProdi,
            'options' => [
                'placeholder' => 'Pilih Program Studi'
            ]
        ])->label('Program Studi') ?>

        <div class="kt-form__actions">
            <?= Html::submitButton('<i class="la la-search"></i> Cari',
                ['class' => 'btn btn-success btn-pill btn-elevate btn-elevate-air']) ?>
        </div>

        <?php ActiveForm::end() ?>


    </div>


    <!--end::Form-->
</div>

