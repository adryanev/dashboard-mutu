<?php

use common\models\ProgramStudi;
use common\models\standar7\akreditasi\S7Akreditasi;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

/* @var $dataProgram ProgramStudi*/
/* @var $dataAkreditasiProdi S7Akreditasi*/
/* @var $dataProdi ProgramStudi*/


$this->title = "Pencarian Data Program Studi";

$this->params['breadcrumbs'][] = ['label'=>'Beranda','url'=>['/site/index']];
$this->params['breadcrumbs'][] = ['label'=>'9 Kriteria','url'=>['/kriteria9/default/index']];
$this->params['breadcrumbs'][] = $this->title;

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

                <?php $form = ActiveForm::begin() ?>


                <?= $form->field($model, 'id_prodi')->widget(Select2::class, [
                    'data' => $dataProdi,
                    'options' => [
                        'placeholder' => 'Pilih Program Studi'
                    ]
                ])->label('Program Studi') ?>

                <div class="kt-form__actions">
                    <?= Html::submitButton('<i class="la la-search"></i> Cari', ['class' => 'btn btn-success btn-pill btn-elevate btn-elevate-air']) ?>
                </div>

                <?php ActiveForm::end() ?>


        </div>


    <!--end::Form-->
</div>

