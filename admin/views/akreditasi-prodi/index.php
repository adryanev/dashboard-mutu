<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel admin\models\K9AkreditasiProdiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akreditasi Prodi';
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
                        <?= Html::encode($this->title) ?> <small>Data Akreditasi Prodi</small>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <?= Html::button('<i class=flaticon2-add></i> Tambah Akreditasi Prodi', ['value' => Url::to(['akreditasi-prodi/create']), 'title' => 'Tambah Akreditasi Prodi', 'class' => 'showModalButton btn btn-success btn-elevate btn-elevate-air']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="k9-akreditasi-prodi-index">




                        <?php Pjax::begin(); ?>
                                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    
                                            <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
        'columns' => [
                        ['class' => 'yii\grid\SerialColumn','header'=>'No'],

//                                    'id',
            'akreditasi.nama',
            'prodi.nama',
//            'created_at:datetime',
//            'updated_at:datetime',
            'progress',

                        ['class' => 'common\widgets\ActionColumn','header'=>'Aksi','template' => '{view} {delete}'],
                        ],
                        ]); ?>
                    
                        <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



