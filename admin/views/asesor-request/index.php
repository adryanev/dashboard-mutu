<?php
/**
 * @var $this View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = 'Permintaan Akses Asesor';
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
                        <?= $this->title ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="k9-akreditasi-index">


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],

//                                    'id',
                            'asesor.username',
                            [
                                'label' => 'Untuk',
                                'value' => function ($model) {
                                    if ($model->id_prodi) {
                                        return $model->prodi->nama;
                                    }
                                    return 'Perguruan Tinggi';
                                }
                            ],
                            'izinkan:boolean',
                            'created_at:datetime',
                            'updated_at:datetime',

                            [
                                'class' => 'common\widgets\ActionColumn',
                                'header' => 'Aksi',
                                'template' => '{izinkan}{cabut}',
                                'buttons' => [
                                    'izinkan' => function ($url, $model) {
                                        if ($model->izinkan) {
                                            return null;
                                        }
                                        return Html::a('Izinkan', ['asesor-request/accept'], [
                                            'class' => 'btn btn-success btn-sm btn-pill btn-elevate btn-elevate-air',
                                            'data' => [
                                                'method' => 'POST',
                                                'confirm' => 'Apakah anda ingin memberikan akses?',
                                                'params' => ['asesor' => $model->id_asesor, 'prodi' => $model->id_prodi]
                                            ]
                                        ]);
                                    },
                                    'cabut' => function ($url, $model) {
                                        return Html::a('Cabut Izin', ['asesor-request/reject'], [
                                            'class' => 'btn btn-danger btn-sm btn-pill btn-elevate btn-elevate-air',
                                            'data' => [
                                                'method' => 'POST',
                                                'confirm' => 'Apakah anda ingin menolak / mencabut izin?',
                                                'params' => ['asesor' => $model->id_asesor, 'prodi' => $model->id_prodi]
                                            ]
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
