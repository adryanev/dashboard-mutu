<?php

use common\models\FakultasAkademi;
use common\models\User;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\forms\user\UpdateUserForm */
/* @var $modelPassword common\models\forms\user\UpdatePasswordForm */
/* @var $form ActiveForm */
/* @var $dataFakultas [] */
/* @var $dataProdi [] */
/* @var $dataUnit [] */
/* @var $dataRoles [] */
/* @var $tipe [] */
$this->title = 'Update Pengguna';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-add-1"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="user-create">

                    <div class="update_user_form">

                        <?php $form = ActiveForm::begin(['id'=>'update-user-form']); ?>

                        <?= $form->field($model, 'username')->textInput() ?>
                        <?= $form->field($model, 'email')->textInput() ?>
                        <?= $form->field($model, 'status')->dropDownList([User::STATUS_ACTIVE => 'Aktif', User::STATUS_INACTIVE => 'Tidak Aktif'], ['prompt' => 'Pilih Status User']) ?>
                        <?= $form->field($model, 'hak_akses')->dropDownList( $dataRoles,['prompt'=>'Pilih Hak Akses']) ?>

                        <?= $form->field($model, 'nama_lengkap')->textInput() ?>

                        <?=$form->field($model,'tipe')->widget(Select2::class,[
                                'data' => $tipe,
                            'options' => [
                                'id' => 'tipe',
                            ],
                            'pluginOptions' => [
                                    'placeholder'=>'Pilih Tipe Akun',
                                'allowClear'=>true
                            ]
                        ])?>


                        <?= $form->field($model, 'id_fakultas',[ 'options'=>['class'=>'d-none form-group']])->widget(Select2::class, [
                            'data' => $dataFakultas,
                            'options' => [
                                    'id'=>'id_fakultas',

                                'class'=>'hidden'
                            ],
                            'pluginOptions' => [
                                'placeholder' => 'Pilih Fakultas/Akademi',
                            ]
                        ]) ?>
                        <?= $form->field($model, 'id_prodi',[ 'options'=>['class'=>'d-none form-group']])->widget(Select2::class, [
                            'data' => $dataProdi,
                            'options' => [
                                    'id'=>'id_prodi',
                                    'class'=>'hidden'
                            ],
                            'pluginOptions' => [
                                'placeholder' => 'Pilih Program Studi',
                            ]
                        ]) ?>
                        <?= $form->field($model,'id_unit',[ 'options'=>['class'=>'d-none form-group']])->widget(Select2::class,[
                                'data' => $dataUnit,

                            'options' => [
                                    'id'=>'id_unit',

                            ],
                            'pluginOptions' => [
                                    'placeholder'=>'Pilih Unit / Lembaga / Satker',
                               ]
                        ])->label('Unit / Lembaga / Satker')?>

                        <div class="form-group">
                            <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>

                    </div><!-- create_user_form -->


                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-add-1"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="user-create">

                    <div class="update_password_from">

                        <?php $form = ActiveForm::begin(['id'=>'update-password-form']); ?>

                        <?= $form->field($modelPassword, 'oldPassword')->passwordInput() ?>
                        <?= $form->field($modelPassword, 'newPassword')->passwordInput() ?>
                        <?= $form->field($modelPassword, 'repeatPassword')->passwordInput() ?>


                        <div class="form-group">
                            <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>

                    </div><!-- create_user_form -->


                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>

<?php
$js = <<<JS
    $(document).ready(function(){
        const tipe = $("#tipe").val();
        if(tipe === 'programStudi'){
            $("#id_prodi").parent().removeClass("d-none");
        }
        if(tipe === 'fakultasAkademi'){
            $("#id_fakultas").parent().removeClass("d-none");
        }
        if(tipe === 'unit'){
            $("#id_unit").parent().removeClass("d-none");
        }
    });
    $('#tipe').on('change', function() {
        if(this.value === 'programStudi'){
            $("#id_prodi").parent().removeClass("d-none");
            $("#id_fakultas").parent().addClass("d-none");
            $("#id_unit").parent().addClass("d-none");
        }
        if(this.value === 'fakultasAkademi'){
             $("#id_prodi").parent().addClass("d-none");
            $("#id_fakultas").parent().removeClass("d-none");
            $("#id_unit").parent().addClass("d-none");
        }
        if(this.value==='unit'){
             $("#id_prodi").parent().addClass("d-none");
            $("#id_fakultas").parent().addClass("d-none");
            $("#id_unit").parent().removeClass("d-none");
        }
    });
    
JS;

$this->registerJs($js);