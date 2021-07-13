<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\FakultasAkademiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fakultas';
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
                        <?= Html::encode($this->title) ?> <small><?= Yii::$app->params['institusi'] ?></small>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <?= Html::button('<i class=flaticon2-add></i> Tambah Fakultas', ['value' => Url::to(['fakultas-akademi/create']), 'title' => 'Tambah Fakultas', 'class' => 'showModalButton btn btn-success btn-elevate btn-elevate-air']); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="fakultas-akademi-index">


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
                            'dekan',
//            'created_at:datetime',
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



