<?php

use common\models\kriteria9\kuantitatif\prodi\K9DataKuantitatifProdi;
use common\models\ProgramStudi;
use yii\bootstrap4\Html;

/* @var $dataKuantitatifProdi K9DataKuantitatifProdi */
/* @var $prodi ProgramStudi */
/* @var $akreditasiProdi ProgramStudi */

$this->title = "Data Kuantitatif";
$this->params['breadcrumbs'][] = ['label' => 'Beranda', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = ['label' => '9 Kriteria', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = [
    'label' => 'Program Studi',
    'url' => ['/kriteria9/k9-prodi/default/index', 'prodi' => $prodi->id]
];
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Form Data Kuantitatif

            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-actions">
                <?= Html::button('<i class="la la-upload"></i> Unggah Kuantitatif', [
                    'class' => 'showModalButton btn btn-primary btn-pill btn-elevate btn-elevate-air',
                    'title' => 'Unggah Berkas Kuantitatif',
                    'value' => \yii\helpers\Url::to([
                        'kuantitatif/isi',
                        'akreditasiprodi' => $akreditasiProdi->id,
                        'prodi' => $prodi->id
                    ])
                ]) ?>
                <?= Html::a('<i class="fas fa-file-excel"></i> Export Kuantitatif', ['kuantitatif/export'],
                    [
                        'class' => 'btn btn-success btn-pill btn-elevate btn-elevate-air',
                        'data-confirm' => 'Export Kuantitatif masih versi beta dan belum sempurna, tetap lanjutkan?',
                        'data-method' => 'POST',
                        'data-params' => ['akreditasiprodi' => $akreditasiProdi->id]
                    ]) ?>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <div class="kt-section kt-section--first" style="margin-bottom: 0;">

            <div class="alert alert-warning">
                Hasil Ekspor Kuantitatif masih beta dan belum sempurna, mohon diperiksa hasilnya.
            </div>
            <?= \kartik\grid\GridView::widget([
                'dataProvider' => $dataKuantitatifProdi,
                'summary' => false,
                'columns' => [
                    ['class' => \kartik\grid\SerialColumn::class, 'header' => 'No'],
                    'nama_dokumen',
                    'isi_dokumen',
                    'updated_at:datetime',
                    'sumber',
                    [
                        'class' => \common\widgets\ActionColumn::class,
                        'header' => 'Aksi',
                        'template' => '{lihat}{download}{hapus}',
                        'buttons' => [
                            'lihat' => function ($url, $model, $key) {
                                return Html::button('<i class="la la-eye"></i>',
                                    [
                                        'class' => 'showModalButton btn btn-pill btn-sm btn-elevate btn-elevate-air btn-primary',
                                        'value' => \yii\helpers\Url::to(['show', 'id' => $model->id]),
                                        'title' => $model->nama_dokumen
                                    ]);
                            },
                            'download' => function ($url, $model, $key) use ($prodi) {
                                return Html::a('<i class ="la la-download"></i>',
                                    ['kuantitatif/download-dokumen', 'dokumen' => $model->id, 'prodi' => $prodi->id],
                                    ['class' => 'btn btn-pill btn-sm btn-elevate btn-elevate-air btn-warning']);
                            },
                            'hapus' => function ($url, $model, $key) use ($prodi) {
                                return Html::a('<i class ="la la-trash"></i>', ['kuantitatif/hapus-dokumen'], [
                                    'class' => 'btn btn-sm btn-pill btn-elevate btn-elevate-air btn-danger',
                                    'data' => [
                                        'method' => 'POST',
                                        'confirm' => 'Apakah anda yakin menghapus ' . $model->nama_dokumen . ' ?',
                                        'params' => ['id' => $model->id, 'prodi' => $prodi->id]
                                    ]
                                ]);
                            }
                        ]
                    ]
                ]
            ]) ?>

        </div>
    </div>
</div>

