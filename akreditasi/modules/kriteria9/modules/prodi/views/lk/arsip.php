<?php


use demogorgorn\ajax\AjaxSubmitButton;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\web\JsExpression;

/* @var $dataProdi */
/* @var $dataAkreditasiProdi */

$this->title = "Pencarian Data Program Studi Dokumentasi";

$this->params['breadcrumbs'][] = ['label' => 'Beranda', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = ['label' => '9 Kriteria', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = [
    'label' => 'Program Studi',
    'url' => ['/kriteria9/k9-prodi/default/index', 'prodi' => $_GET['prodi']]
];

?>
<!--card-->

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Form Pencarian Data Program Studi
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <div class="kt-portlet__body">

        <?php $form = ActiveForm::begin(['id' => 'form-pencarian-lk', 'options' => ['class' => 'kt-form']]) ?>

        <?= $form->field($model, 'akreditasi')->widget(Select2::class, [
            'data' => $dataAkreditasiProdi,
            'options' => [
                'placeholder' => 'Pilih Akreditasi'
            ]
        ]) ?>
        <?= $form->field($model, 'id_prodi')->widget(Select2::class, [
            'data' => $dataProdi
        ])->label('Program Studi') ?>

        <div class="kt-form__actions">

            <?php AjaxSubmitButton::begin([
                'label' => 'Cari',
                'icon' => 'la la-search',
                'useWithActiveForm' => 'form-pencarian-lk',
                'ajaxOptions' => [
                    'type' => 'POST',
                    'success' => new JsExpression('function(html){
                    $("#hasil-arsip").html(html);
                        normalizeButton("submit-form",{icon:"la la-search",text:"Cari"});
                    }')


                ],
                'options' => [
                    'class' => 'btn btn-success btn-pill btn-elevate btn-elevate-air',
                    'type' => 'submit',
                    'id' => 'submit-form'
                ]
            ]);

            AjaxSubmitButton::end();

            ?>

        </div>

        <?php ActiveForm::end() ?>


    </div>

    <!--end::Form-->
</div>

<div id="hasil-arsip"></div>

