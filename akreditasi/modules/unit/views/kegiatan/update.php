<?php

use akreditasi\models\unit\KegiatanDetailUploadForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model akreditasi\models\unit\KegiatanUnitForm */

$this->title = 'Ubah Kegiatan Unit: ' . $model->getKegiatan()->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Unit', 'url' => ['index','unit'=>$_GET['unit']]];
$this->params['breadcrumbs'][] = ['label' => $model->getKegiatan()->nama, 'url' => ['view', 'id' => $model->getKegiatan()->id,'unit'=>$_GET['unit']]];
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
                <div class="kegiatan-unit-update">

                    <?= $this->render('_form', [
                    'model' => $model,
                        'path'=>$path


                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



