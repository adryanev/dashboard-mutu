<?php

use common\models\User;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Edit Akun'

?>
<!--Begin::App-->
<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

    <!--Begin:: App Aside Mobile Toggle-->
    <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
        <i class="la la-close"></i>
    </button>

    <!--End:: App Aside Mobile Toggle-->

    <?=$this->render('../aside/profile_aside')?>


    <!--Begin:: App Content-->
    <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-edit"></i>
                    </span>
                            <h3 class="kt-portlet__head-title">
                                <?= Html::encode($this->title) ?>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="user-create">

                            <div class="update_user_form">

                                <?php $form = ActiveForm::begin(); ?>

                                <?= $form->field($model, 'username')->textInput() ?>
                                <?= $form->field($model, 'email')->textInput() ?>
                                <?= $form->field($model, 'nama_lengkap')->textInput() ?>


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
    </div>

    <!--End:: App Content-->
</div>

<!--End::App-->


