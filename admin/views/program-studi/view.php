<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProgramStudi */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Program Studi', 'url' => ['index']];
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
                        <?= Html::encode($this->title) ?> <small>(<?=Html::encode($model->fakultasAkademi->nama)?>)</small>
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
                <div class="program-studi-view">


                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                                'id',
            'kode',
            'nama',
            'jurusan_departemen',
            'fakultasAkademi.nama',
            'nomor_sk_pendirian',
            'tanggal_sk_pendirian',
            'pejabat_ttd_sk_pendirian',
            'bulan_berdiri',
            'tahun_berdiri',
            'nomor_sk_operasional',
            'tanggal_sk_operasional',
            'peringkat_banpt_terakhir',
            'nilai_banpt_terakhir',
            'nomor_sk_banpt',
            'alamat',
            'kodepos',
            'nomor_telp',
            'homepage',
            'email:email',
            'kaprodi',
            'jenjang',
            'created_at:datetime',
            'updated_at:datetime',
                    ],
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



