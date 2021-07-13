<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\sertifikat\SertifikatProdi */

$this->title = $model->prodi->nama;
$this->params['breadcrumbs'][] = ['label' => 'Sertifikat Prodi', 'url' => ['index']];
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
                <div class="sertifikat-prodi-view">


                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                                'id',
            'prodi.nama',
            'nama_lembaga',
            'tgl_akreditasi:date',
            'tgl_kadaluarsa:date',
            'nomor_sk',
            'nomor_sertifikat',
            'nilai_angka',
            'nilai_huruf',
            'tahun_sk',
            'tanggal_pengajuan:date',
            'tanggal_diterima:date',
            'is_publik',
//            'dokumen_sk:image',
            [
                'attribute' => 'dokumen_sk',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->dokumen_sk."&nbsp;<i class='fa fa-external-link-alt'></i>", ['sertifikat-prodi/lihat-sk','id'=> $model->id],['target' => '_blank', 'data-pjax'=>"0"]);
                }
            ],
            [
                'attribute' => 'sertifikat',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->sertifikat."&nbsp;<i class='fa fa-external-link-alt'></i>", ['sertifikat-prodi/lihat-sertifikat','id'=> $model->id],['target' => '_blank', 'data-pjax'=>"0"]);
                }
            ],
//            'sertifikat:image',
            'created_at:date',
            'updated_at:date',
            'createdBy.profilUser.nama_lengkap',
            'updatedBy.profilUser.nama_lengkap',
                    ],
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



