<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\ProgramStudiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Program Studi';
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

                            <?= Html::button('<i class=flaticon2-add></i> Tambah Program Studi', ['value' => Url::to(['create']), 'title' => 'Tambah Program Studi', 'class' => 'showModalButton btn btn-success btn-elevate btn-elevate-air']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="program-studi-index">


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],

//                                    'id',
                            'kode',
                            'nama',
//            'jurusan_departemen',
                            [
                                'attribute' => 'id_fakultas_akademi',
                                'value' => 'fakultasAkademi.nama',
                                'label' => 'Fakultas'
                            ],
                            //'nomor_sk_pendirian',
                            //'tanggal_sk_pendirian',
                            //'pejabat_ttd_sk_pendirian',
                            //'bulan_berdiri',
                            //'tahun_berdiri',
                            //'nomor_sk_operasional',
                            //'tanggal_sk_operasional',
                            //'peringkat_banpt_terakhir',
                            //'nilai_banpt_terakhir',
                            //'nomor_sk_banpt',
                            //'alamat',
                            //'kodepos',
                            //'nomor_telp',
                            //'homepage',
                            //'email:email',
                            //'kaprodi',
                            //'jenjang',
                            //'created_at',
                            //'updated_at',

                            ['class' => 'common\widgets\ActionColumn', 'header' => 'Aksi'],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



