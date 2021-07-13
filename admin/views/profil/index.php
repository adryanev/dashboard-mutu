<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $model common\models\Profil
 */


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
                        <i class="flaticon2-edit"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <?= Html::a('<i class=flaticon2-edit></i> Edit Profil', ['profil/update'], ['class' => 'btn btn-info btn-elevate btn-elevate-air']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="profil-institusi">
                    <?=\yii\widgets\DetailView::widget([
                            'model' => $model,
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



