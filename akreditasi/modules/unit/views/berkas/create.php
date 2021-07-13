<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Berkas */
/* @var $detailModel common\models\DetailBerkas */
/* @var $urlPath string */

$this->title = 'Tambah Berkas';
$this->params['breadcrumbs'][] = ['label' => 'Berkas', 'url' => ['index','unit'=>$_GET['unit']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-add-1"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="berkas-create">

                    <?= $this->render('_form', [
                    'model' => $model,
                        'detailModel'=>$detailModel,
                        'urlPath'=>$urlPath
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>

