<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $programstudi common\models\ProgramStudi */
/**
 * @var $model common\models\Profil
 */

$this->title = 'Profil: ' . $programstudi->nama;
$this->params['breadcrumbs'][] = ['label' => 'Program Studi', 'url' => ['/kriteria9/prodi/arsip']];
$this->params['breadcrumbs'][] = ['label' => $programstudi->nama, 'url' => ['default/index', 'prodi' => $programstudi->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-edit"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <?= Html::a('<i class=flaticon2-edit></i> Edit Prodi', ['profil/update', 'prodi' => Yii::$app->request->get('prodi')], ['class' => 'btn btn-info btn-elevate btn-elevate-air']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="program-studi-prodi">
                    <?=\yii\widgets\DetailView::widget([
                        'model' => $programstudi,
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
                        ]
                    )?>


                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-edit"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <?= Html::a('<i class=flaticon2-edit></i> Edit Profil Prodi', ['profil/update-profil', 'prodi' => Yii::$app->request->get('prodi')], ['class' => 'btn btn-info btn-elevate btn-elevate-air']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="program-studi-prodi">
                    <?=\yii\widgets\DetailView::widget([
                            'model' => $programstudi->profil,
                            'attributes' => [
//                                'id',
                                'visi:html',
                                'misi:html',
                                'tujuan:html',
                                'sasaran:html',
                                'motto:html',
                                'sambutan:html',
                                ['attribute'=>'struktur_organisasi',
                                    'format'=>['image',['width'=>'50%']],
                                    'value'=>function($model){
                        return Yii::getAlias("@.uploadStruktur/{$model->type}/{$model->external_id}/$model->struktur_organisasi");
                                    }]
                            ],
                        ]
                    )?>


                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>


