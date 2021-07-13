<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Berkas';
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

                            <?= Html::button('<i class=flaticon2-add></i> Tambah Berkas', [
                                'value' => Url::to(['create', 'unit' => Yii::$app->request->get('unit')]),
                                'title' => 'Tambah Berkas',
                                'class' => 'showModalButton btn btn-success btn-elevate btn-elevate-air'
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="berkas-index">


                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],

//                                            'id',
//                                            'external_id',
//                                            'type',
                            'nama_berkas',
                            'created_at:datetime',
                            //'updated_at',

                            [
                                'class' => 'common\widgets\ActionColumn',
                                'header' => 'Aksi',
                                'buttons' => [
                                    'view' => function ($url, $model, $key) {
                                        return Html::a('<i class="flaticon2-information"></i> Lihat',
                                            ['berkas/view', 'id' => $model->id, 'unit' => $_GET['unit']],
                                            ['class' => ' btn btn-sm btn-pill btn-elevate btn-elevate-air btn-info']);
                                    },
                                    'update' => function ($url, $model, $key) {
                                        return Html::a('<i class="flaticon2-edit"></i> Ubah',
                                            ['berkas/update', 'id' => $model->id, 'unit' => $_GET['unit']],
                                            ['class' => ' btn btn-sm btn-pill btn-elevate btn-elevate-air btn-warning']);
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a('<i class="flaticon2-delete"></i> Hapus',
                                            ['berkas/delete', 'id' => $model->id, 'unit' => $_GET['unit']], [
                                                'class' => ' btn btn-sm btn-pill btn-elevate btn-elevate-air btn-danger',
                                                'data-confirm' => Yii::t('yii',
                                                    'Apakah anda yakin untuk menghapus item ini?'),
                                                'data-method' => 'post',
                                            ]);
                                    }


                                ]
                            ],
                        ],
                    ]); ?>


                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>
