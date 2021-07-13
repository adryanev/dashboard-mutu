<?php
/**
 * @var $this yii\web\View
 * @var $verified yii\data\ActiveDataProvider
 * @var $notVerified yii\data\ActiveDataProvider
 */

use common\helpers\FileTypeHelper;
use yii\bootstrap4\Html;

$this->title = 'Verifikasi Dokumentasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Belum diverifikasi.
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <?= \kartik\grid\GridView::widget([
            'dataProvider' => $notVerified,
            'summary' => false,
            'columns' => [
                ['class' => \kartik\grid\SerialColumn::class, 'header' => 'No.'],
                'prodi.nama',
                'nama_dokumen',
                'isi_dokumen',
                'komentar',
                [
                    'class' => \common\widgets\ActionColumn::class,
                    'header' => 'Aksi',
                    'template' => '{view}{comment}{accept}',
                    'buttons' => [
                        'comment'=> function($url, $model, $key){
                            return Html::button('<i class="flaticon2-chat"></i> Komentar',[
                                'value'=>\yii\helpers\Url::to(['verifikasi-dokumentasi/comments','id'=>$model->id]),
                                'title'=>'Komentar',
                                'class'=>'showModalButton btn btn-sm btn-pill btn-elevate btn-elevate-air btn-warning'
                            ]);
                        },
                        'view' => function ($url, $model, $key) {
                            if ($model->bentuk_dokumen === FileTypeHelper::TYPE_LINK) {
                                return Html::a
                                ('<i class="la la-external-link"></i>Lihat', $model->isi_dokumen, [
                                    'class' => 'btn btn-sm btn-pill btn-elevate btn-elevate-air btn-info',
                                    'target' => '_blank'
                                ]);
                            }

                            return Html::button('<i class="flaticon2-information"></i> Lihat', [
                                'value' => \yii\helpers\Url::to(['verifikasi-dokumentasi/view', 'id' => $model->id]),
                                'title' => $model->nama_dokumen,
                                'class' => 'showModalButton btn btn-sm btn-pill btn-elevate btn-elevate-air btn-info'
                            ]);
                        },
                        'accept' => function ($url, $model, $key) {
                            return Html::a('<i class="flaticon2-check-mark"></i> Setujui',
                                ['verifikasi-dokumentasi/approve'],['class'=>'btn btn-sm btn-success btn-pill btn-elevate-air btn-elevate',
                                'data'=>[
                                    'method'=>'POST',
                                    'confirm'=>'Apakah anda ingin menyetujui dokumen ini?',
                                    'params'=>['id'=>$model->id]
                                ],'visible'=>!$model->is_verified]);
                        },
                        'reject' => function ($url, $model, $key) {
                            return Html::a('<i class="flaticon2-cross"></i> Tolak',['verifikasi-dokumentasi/reject'],
                                ['class'=>'btn btn-sm btn-danger btn-pill btn-elevate btn-elevate-air',
                                    'data'=>[
                                        'method'=>'POST',
                                        'confirm'=>'Apakah anda ingin menolak dokumen ini?',
                                        'params'=>['id'=>$model->id]
                                    ]]);



        }
                    ]
                ]
            ]
        ]) ?>
    </div>
</div>
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Sudah diverifikasi.
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <?= \kartik\grid\GridView::widget([
            'dataProvider' => $verified,
            'summary' => false,
            'columns' => [
                ['class' => \kartik\grid\SerialColumn::class, 'header' => 'No.'],
                'prodi.nama',
                'nama_dokumen',
                'isi_dokumen',
                [
                    'class' => \common\widgets\ActionColumn::class,
                    'header' => 'Aksi',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            if ($model->bentuk_dokumen === FileTypeHelper::TYPE_LINK) {
                                return Html::a
                                ('<i class="la la-external-link"></i>Lihat', $model->isi_dokumen, [
                                    'class' => 'btn btn-sm btn-pill btn-elevate btn-elevate-air btn-info',
                                    'target' => '_blank'
                                ]);
                            }

                            return Html::button('<i class="flaticon2-information"></i> Lihat', [
                                'value' => \yii\helpers\Url::to(['verifikasi-dokumentasi/view', 'id' => $model->id]),
                                'title' => $model->nama_dokumen,
                                'class' => 'showModalButton btn btn-sm btn-pill btn-elevate btn-elevate-air btn-info'
                            ]);
                        },
                    ]
                ]
            ]
        ]) ?>
    </div>
</div>
