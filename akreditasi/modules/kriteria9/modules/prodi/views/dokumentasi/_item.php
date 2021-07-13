<?php
/**
 * @var $model \common\models\kriteria9\dokumentasi\prodi\DokumentasiProdi
 * @var $key
 * @var $index int
 * @var $widget
 */

use common\helpers\FileIconHelper;
use common\helpers\FileTypeHelper;
use yii\bootstrap4\Html;

?>

<div class="row">
    <div class="col-lg-5 text-center">
        <div class="row">
            <div class="col-lg-12">
                <p><span><?= FileIconHelper::getIconByExtension($model->bentuk_dokumen) ?></span>
                    <?php $type = FileTypeHelper::getType($model->bentuk_dokumen);

                    if ($type === FileTypeHelper::TYPE_STATIC_TEXT || $type === FileTypeHelper::TYPE_LINK) : ?>
                        <?= Html::encode($model->nama_dokumen) ?>

                    <?php else: ?>
                        <?= $model->nama_dokumen . ' (' . $model->isi_dokumen . ')' ?>
                    <?php endif; ?>
                    <?= $model->is_verified ? "<span class='kt-badge kt-badge--success
        kt-badge--inline kt-badge--pill kt-badge--rounded'>verified</span>" : "<span class='kt-badge kt-badge--danger
        kt-badge--inline kt-badge--pill kt-badge--rounded'>not verified</span>" ?>

                    <?php if($model->komentar): ?><span><?=Html::button('<i class="flaticon2-chat-1"></i>',['class'=>'btn btn-outline-hover-info btn-elevate btn-circle btn-icon','data-toggle'=>'kt-popover','title'=>'Komentar LPM','data-content'=>$model->komentar])?></span><?php endif ?>
                </p>
            </div>

        </div>
    </div>
    <div class="col-lg-7 text-right">

        <?php $type = FileTypeHelper::getType($model->bentuk_dokumen);
        if ($type !== FileTypeHelper::TYPE_LINK):?>
            <?= \yii\bootstrap4\Html::button('<i class="la la-eye"></i> Lihat', [
                'value' => \yii\helpers\Url::to([
                    'dokumentasi/lihat',
                    'id' => $model->id
                ]),
                'title' => $model->nama_dokumen,
                'class' => 'showModalButton btn btn-sm btn-info btn-pill
            btn-elevate btn-elevate-air'
            ]) ?>
        <?php else: ?>
            <?= Html::a('<i class="la la-external-link"></i> Lihat', $model->isi_dokumen, [
                'class' => 'btn btn-info btn-sm btn-pill btn-elevate btn-elevate-air',
                'target' => '_blank'
            ]) ?>
        <?php endif; ?>
        <?php if ($type !== FileTypeHelper::TYPE_LINK && $type !== FileTypeHelper::TYPE_STATIC_TEXT): ?>
            <?= Html::a('<i class="la la-download"></i>&nbsp;Unduh', [
                'dokumentasi' . '/download',
                'dokumen' => $model->id,
            ], ['class' => 'btn btn-warning btn-sm btn-pill btn-elevate btn-elevate-air']) ?>
        <?php endif; ?>
        <?= Html::a('<i class ="la la-trash"></i>&nbsp; Hapus', [
            'dokumentasi' . '/hapus'
        ], [
            'class' => 'btn btn-danger btn-sm btn-pill btn-elevate btn-elevate-air',
            'data' => [
                'method' => 'POST',
                'confirm' => 'Apakah anda yakin menghapus item ini?',
                'params' => [
                    'dokumen' => $model->id,
                ]
            ]
        ]) ?>
    </div>
</div>
