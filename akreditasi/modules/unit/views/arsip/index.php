<?php

use common\models\Unit;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $dataUnit Unit*/


$this->title = "Pencarian Data Unit";

$this->params['breadcrumbs'][] = ['label'=>'Beranda','url'=>['/site/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<!--card-->

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Form Pencarian Data Unit
            </h3>
        </div>
    </div>

    <!--begin::Form-->

        <div class="kt-portlet__body">

                <?php $form = ActiveForm::begin() ?>


                <?= $form->field($model, 'id_unit')->widget(Select2::class, [
                    'data' => $dataUnit,
                    'options' => [
                        'placeholder' => 'Pilih Unit'
                    ]
                ])->label('Unit') ?>

                <div class="kt-form__actions">
                    <?= Html::submitButton('<i class="la la-search"></i> Cari', ['class' => 'btn btn-success btn-pill btn-elevate btn-elevate-air']) ?>
                </div>

                <?php ActiveForm::end() ?>


        </div>


    <!--end::Form-->
</div>

