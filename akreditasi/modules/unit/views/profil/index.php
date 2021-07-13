<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $unit common\models\Unit */
/**
 * @var $model common\models\Profil
 */

$this->title = 'Profil: ' . $unit->nama;
$this->params['breadcrumbs'][] = ['label' => 'Unit', 'url' => ['/unit/arsip/index']];
$this->params['breadcrumbs'][] = ['label' => $unit->nama, 'url' => ['default/index', 'unit' => $unit->id]];
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

                            <?= Html::a('<i class=flaticon2-edit></i> Edit Unit', ['profil/update', 'unit' => Yii::$app->request->get('unit')], ['class' => 'btn btn-info btn-elevate btn-elevate-air']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="program-studi-unit">
                    <?=\yii\widgets\DetailView::widget([
                        'model' => $unit,
                            'attributes' => [
                                'id',
                                'nama',
                                'created_at:datetime',
                                'updated_at:datetime',
                            ],
                        ]
                    )?>


                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>

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

                            <?= Html::a('<i class=flaticon2-edit></i> Edit Profil Unit', ['profil/update-profil', 'unit' => Yii::$app->request->get('unit')], ['class' => 'btn btn-info btn-elevate btn-elevate-air']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="program-studi-unit">
                    <?=\yii\widgets\DetailView::widget([
                            'model' => $unit->profil,
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


