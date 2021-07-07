<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel akreditasi\models\unit\KegiatanUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$unit = $_GET['unit'];
$this->title = 'Kegiatan Unit';
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
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <?= Html::button('<i class=flaticon2-add></i> Tambah Kegiatan Unit', [
                                'value' => Url::to(['create', 'unit' => $_GET['unit']]),
                                'title' => 'Tambah Kegiatan Unit',
                                'class' => 'showModalButton btn btn-success btn-elevate btn-elevate-air'
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kegiatan-unit-index">


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],

//                            'id',
//            'id_unit',
                            'nama',
                            'deskripsi:html',
                            'waktu_mulai:datetime',
                            'waktu_selesai:datetime',
                            //'created_at',
                            //'updated_at',

                            [
                                'class' => 'common\widgets\ActionColumn',
                                'header' => 'Aksi',
                                'buttons' => [
                                    'view' => function ($url, $model) use ($unit) {
                                        $link = Url::to(['kegiatan/view', 'id' => $model->id, 'unit' => $unit]);
                                        return Html::a('<i class="flaticon2-information"> </i>Lihat', $link,
                                            ['class' => 'btn btn-sm btn-pill btn-elevate btn-elevate-air btn-info']);
                                    },
                                    'update' => function ($url, $model) use ($unit) {
                                        $link = Url::to(['kegiatan/update', 'id' => $model->id, 'unit' => $unit]);
                                        return Html::a('<i class="flaticon2-edit"> </i>Ubah', $link,
                                            ['class' => 'btn btn-sm btn-pill btn-elevate btn-elevate-air btn-warning']);
                                    },
                                    'delete' => function ($url, $model) use ($unit) {
                                        $link = Url::to(['kegiatan/delete', 'id' => $model->id, 'unit' => $unit]);
                                        return Html::a('<i class="flaticon2-delete"></i>Hapus', $link, [
                                            'class' => 'btn btn-sm btn-pill btn-elevate btn-elevate-air btn-danger',
                                            'data' => [
                                                'confirm' => 'Apakah anda ingin menghapus item ini?',
                                                'method' => 'post',
                                            ],
                                        ]);
                                    }
                                ]
                            ],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



