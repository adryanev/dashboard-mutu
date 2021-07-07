<?php

use common\models\User;
use yii\widgets\DetailView;

$this->title = 'Profil : '.Yii::$app->user->identity->username;
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
            <div class="col-xl-12">

                <!--begin:: Widgets/Order Statistics-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Informasi Akun
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
//                            'id',
                                        'username',
//                            'auth_key',
//                            'password_hash',
//                            'password_reset_token',
//                            'verification_token',
                                        'email:email',
                                        'profilUser.nama_lengkap',
                                        'profilUser.prodi.nama',
                                        ['attribute' => 'status',
                                            'value' => function ($model) {
                                                $status = '';
                                                if ($model->status === User::STATUS_ACTIVE) {
                                                    $status .= 'Aktif';
                                                } elseif ($model->status === User::STATUS_INACTIVE) {
                                                    $status .= "Tidak Aktif";
                                                } else {
                                                    $status .= "Dihapus";
                                                }
                                                return $status;
                                            }],
                                        ['label' => 'Hak Akses', 'attribute' => 'role.item_name'],
                                        'created_at:datetime',
                                        'updated_at:datetime',

                                    ],
//

                                ]) ?>

                            </div>


                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Order Statistics-->
            </div>

        </div>

    </div>

    <!--End:: App Content-->
</div>

<!--End::App-->
