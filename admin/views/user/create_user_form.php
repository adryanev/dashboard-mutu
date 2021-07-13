<?php

use common\models\FakultasAkademi;
use common\models\User;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\forms\user\CreateUserForm */
/* @var $form ActiveForm */
/* @var $dataFakultas [] */
/* @var $dataProdi [] */
/* @var $dataUnit [] */
/*  @var $dataRoles []*/
/*  @var $tipe []*/

$this->title = 'Tambah Pengguna';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
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
                <div class="user-create">

                    <?=$this->render('_create_user_form',['model'=>$model,'dataFakultas'=>$dataFakultas,'dataRoles'=>$dataRoles,'dataProdi'=>$dataProdi,'dataUnit'=>$dataUnit,'tipe'=>$tipe])?>


                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>

