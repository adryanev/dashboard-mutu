<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProgramStudi */
/* @var $profil common\models\Profil */
/* @var $strukturModel akreditasi\models\StrukturOrganisasiUploadForm */

$this->title = 'Update Profil Program Studi: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Program Studi', 'url' => ['/kriteria9/prodi/arsip']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['default/index', 'prodi' => $model->id]];
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
            </div>
            <div class="kt-portlet__body">
                <div class="program-studi-update">

                    <?= $this->render('_form-profil', [
                    'model' => $model,
                        'profil'=>$profil,
                        'strukturModel'=>$strukturModel

                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



