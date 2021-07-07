<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\sertifikat\SertifikatProdiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sertifikat Prodi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-list-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <?= Html::button('<i class=flaticon2-add></i> Tambah Sertifikat Prodi', ['value' => Url::to(['create']), 'title' => 'Tambah Sertifikat Prodi', 'class' => 'showModalButton btn btn-success btn-elevate btn-elevate-air']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="sertifikat-prodi-index">




                        <?php Pjax::begin(); ?>
                                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    
                                            <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
        'columns' => [
                        ['class' => 'yii\grid\SerialColumn','header'=>'No'],

//                                    'id',
            'prodi.nama',
//            'nama_lembaga',
            'tgl_akreditasi:date',
            'tgl_kadaluarsa:date',
            //'nomor_sk',
            //'nomor_sertifikat',
            //'nilai_angka',
            //'nilai_huruf',
            //'tahun_sk',
            //'tanggal_pengajuan',
            //'tanggal_diterima',
            //'is_publik',
            //'dokumen_sk',
            [
                'attribute' => 'sertifikat',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->sertifikat."&nbsp;<i class='fa fa-external-link-alt'></i>", ['sertifikat-prodi/lihat-sertifikat','id'=> $model->id],['target' => '_blank', 'data-pjax'=>"0"]);
                }
            ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

                        ['class' => 'common\widgets\ActionColumn','header'=>'Aksi'],
                        ],
                        ]); ?>
                    
                        <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



