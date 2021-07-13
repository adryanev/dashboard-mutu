<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\ProfilInstitusiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profil Institusi';
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
                        <?= Html::encode($this->title) ?> <small><?=Yii::$app->params['institusi']?></small>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <?= Html::button('<i class=flaticon2-add></i> Tambah Profil Institusi', [
                                'value' => Url::to(['create']),
                                'title' => 'Tambah Profil Institusi',
                                'class' => 'showModalButton btn btn-success btn-elevate btn-elevate-air'
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="profil-institusi-index">


                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],

                            // 'id',
                            'nama',
                            'isi:ntext',
                            'created_at:datetime',
                            'updated_at:datetime',

                            ['class' => 'common\widgets\ActionColumn', 'header' => 'Aksi'],
                        ],
                    ]); ?>


                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>
