<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
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
                        <i class="flaticon2-list-3"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                        <small><?= "({$model->profilUser->nama_lengkap})" ?></small>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">


                            <?= Html::a('<i class=flaticon2-edit></i> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-elevate btn-elevate-air']) ?>
                            <?= Html::a('<i class=flaticon2-delete></i> Hapus', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger btn-elevate btn-elevate-air',
                                'data' => [
                                    'confirm' => 'Apakah anda ingin menghapus item ini?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="user-view">
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
                            'profilUser.prodi.fakultasAkademi.nama',
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
        <!--end::Portlet-->

    </div>
</div>



