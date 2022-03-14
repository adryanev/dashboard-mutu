<?php

/**
 * @var $this yii\web\View
 */

?>
<div class="list-kuantitatif">
    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            ['class' => \kartik\grid\SerialColumn::class, 'header' => 'No.'],
            'nama_dokumen',
            'isi_dokumen',
            'created_at',
            'sumber',
            [
                'class' => \common\widgets\ActionColumn::class,
                'header' => 'Aksi',
                'template' => '{download}',
                'buttons' => [
                    'download' => function ($url, $model) use ($untuk) {
                        return \yii\bootstrap4\Html::a(
                            '<i class="flaticon2-arrow-down"></i> Download',
                            $untuk === 'prodi' ? [
                                'kuantitatif/download-prodi',
                                'id' => $model->id
                            ] : null,
                            [
                                'class' => 'btn btn-sm btn-primary btn-pill btn-elevate btn-elevate-air',
                            ]
                        );
                    }
                ]
            ]
        ]
    ]) ?>
</div>
