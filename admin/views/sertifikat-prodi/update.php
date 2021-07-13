<?php

use common\models\ProgramStudi;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\sertifikat\SertifikatProdi */
/* @var $dataProdi ProgramStudi */

$this->title = 'Ubah Sertifikat Prodi:  ' . $model->prodi->nama;
$this->params['breadcrumbs'][] = ['label' => 'Sertifikat Prodi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prodi->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
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
            </div>
            <div class="kt-portlet__body">
                <div class="sertifikat-prodi-update">

                    Nama Prodi
                    <div class="kt-space-5"></div>

                    <h5><?= $model->prodi->nama ?></h5>
                    <div class="kt-space-20"></div>

                    <?= $this->render('_form-update', [
                        'model' => $model,
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



