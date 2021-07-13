<?php
/**
 * @var $this yii\web\View
 * @var $aptDataProvider yii\data\ActiveDataProvider
 * @var $apsDataProvider yii\data\ActiveDataProvider
 */


use common\widgets\ActionColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use yii\bootstrap4\Html;

$this->title = 'Index Asesor';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesor-default-index">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Akreditasi Program Studi
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <?= GridView::widget([
                'dataProvider' => $apsDataProvider,
                'summary' => false,
                'columns' => [
                    ['class' => SerialColumn::class, 'header' => 'No.'],
                    'akreditasi.lembaga',
                    'akreditasi.tahun',
                    'prodi.nama',
                    [
                        'label' => 'Laporan Evaluasi Diri',
                        'value' => function ($model, $key, $index, $widget) {
                            return $model->k9LedProdi->progress;
                        },
                    ],
                    [
                        'label' => 'Laporan Kinerja',
                        'value' => function ($model, $key, $index, $widget) {
                            return $model->k9LkProdi->progress;
                        }
                    ],
                    [
                        'class' => ActionColumn::class,
                        'header' => 'Aksi',
                        'template' => '{led} {lk} {kuantitatif} {nilai}',
                        'buttons' => [
                            'nilai' => function ($url, $model) {
                                return Html::a(
                                    'Penilaian',
                                    ['prodi/index', 'id' => $model->id],
                                    ['class' => 'btn btn-primary btn-sm']
                                );
                            },
                            'led' => function ($url, $model) {
                                return Html::a(
                                    'Led',
                                    ['led-prodi/lihat', 'led' => $model->k9LedProdi->id, 'prodi' => $model->prodi->id],
                                    ['class' => 'btn btn-success btn-sm']
                                );
                            },
                            'lk' => function ($url, $model) {
                                return Html::a(
                                    'Lk',
                                    ['lk-prodi/lihat', 'lk' => $model->k9LkProdi->id, 'prodi' => $model->prodi->id],
                                    ['class' => 'btn btn-warning btn-sm']
                                );
                            },
                            'kuantitatif' => function ($url, $model) {
                                return !empty($model->kuantitatif) ? Html::button(
                                    'Kuantitatif',
                                    [
                                        'class' => 'btn btn-dark btn-sm showModalButton',
                                        'value' => \yii\helpers\Url::to(['/kuantitatif/prodi', 'id' => $model->id]),
                                        'title' => 'Kuantitatif Prodi'
                                    ]
                                ) : Html::a(
                                    'Kuantitatif',
                                    '#',
                                    ['class' => 'btn btn-dark btn-sm disabled', 'aria-disabled' => true]
                                );
                            }
                        ]
                    ]

                ]
            ]) ?>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Akreditasi Program Tinggi
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <?= GridView::widget([
                'dataProvider' => $aptDataProvider,
                'summary' => false,
                'columns' => [
                    ['class' => SerialColumn::class, 'header' => 'No.'],
                    'akreditasi.lembaga',
                    'akreditasi.tahun',
                    [
                        'label' => 'Laporan Evaluasi Diri',
                        'value' => function ($model, $key, $index, $widget) {
                            return $model->k9LedInstitusi->progress;
                        }
                    ],
                    [
                        'label' => 'Laporan Kinerja',
                        'value' => function ($model, $key, $index, $widget) {
                            return $model->k9LkInstitusi->progress;
                        }
                    ],
                    [
                        'class' => ActionColumn::class,
                        'header' => 'Aksi',
                        'template' => '{led} {lk} {kuantitatif} {nilai}',
                        'buttons' => [
                            'nilai' => function ($url, $model) {
                                return Html::a(
                                    'Penilaian',
                                    ['institusi/index', 'id' => $model->id],
                                    ['class' => 'btn btn-primary btn-sm']
                                );
                            },
                            'led' => function ($url, $model) {
                                return Html::a(
                                    'Led',
                                    ['led-institusi/lihat', 'led' => $model->k9LedInstitusi->id],
                                    ['class' => 'btn btn-success btn-sm']
                                );
                            },
                            'lk' => function ($url, $model) {
                                return Html::a(
                                    'Lk',
                                    ['lk-institusi/lihat', 'lk' => $model->k9LkInstitusi->id],
                                    ['class' => 'btn btn-warning btn-sm']
                                );
                            },
                            'kuantitatif' => function ($url, $model) {
                                return !empty($model->kuantitatif) ? Html::button(
                                    'Kuantitatif',
                                    [
                                        'class' => 'btn btn-dark btn-sm showModalButton',
                                        'value' => \yii\helpers\Url::to(['/kuantitatif/institusi', 'id' => $model->id]),
                                        'title' => 'Kuantitatif Institusi'
                                    ]
                                ) : Html::a(
                                    'Kuantitatif',
                                    '#',
                                    ['class' => 'btn btn-dark btn-sm disabled', 'aria-disabled' => true]
                                );
                            }
                        ]
                    ]
                ]
            ]) ?>
        </div>
    </div>

</div>
