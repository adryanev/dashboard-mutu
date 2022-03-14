<?php
/**
 * @var $this yii\web\View
 */

use common\helpers\FileIconHelper;
use common\helpers\FileTypeHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

if ($this->context->id === 'prodi') {
    $controller = 'lk-prodi';
} else {
    $controller = $this->context->id;
}
?>
<tr>
    <td></td>
    <td>
        <div class="row">
            <div class="col-lg-12 text-center">

                <?= FileIconHelper::getIconByExtension($v->bentuk_dokumen) ?>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p><?= $v->nama_dokumen . ' (' . $v->isi_dokumen . ')' ?>
                    <?= $v->is_verified ? "<span class='kt-badge kt-badge--success
        kt-badge--inline kt-badge--pill kt-badge--rounded'>verified</span>" : "<span class='kt-badge kt-badge--danger
        kt-badge--inline kt-badge--pill kt-badge--rounded'>not verified</span>" ?>

                    <?php if ($v->komentar):
                        ?><span><?=Html::button('<i class="flaticon2-chat-1"></i>', ['class'=>'btn btn-outline-hover-info btn-elevate btn-circle btn-icon','data-toggle'=>'kt-popover','title'=>'Komentar LPM','data-content'=>$v->komentar])?></span><?php
                    endif ?>
                </p>


            </div>
        </div>
    </td>
    <td>
        <div class="row pull-right">
            <div class="col-lg-12">
                <?php $type = FileTypeHelper::getType($v->bentuk_dokumen);
                if ($type !== FileTypeHelper::TYPE_LINK):?>
                    <?= Html::button('<i class="la la-eye"></i> &nbsp;Lihat', [
                        'value' => \yii\helpers\Url::to([
                            $controller . '/lihat-dokumen',
                            'id' => $v->id,
                            'kriteria' => $kriteria
                        ]),
                        'title'=>$v->nama_dokumen,
                        'class'=>'btn btn-info btn-sm btn-pill btn-elevate btn-elevate-air showModalButton'
                    ]) ?>
                <?php else: ?>
                    <?= Html::a('<i class="la la-external-link"></i> Lihat', $v->isi_dokumen, [
                        'class' => 'btn btn-info btn-sm btn-pill btn-elevate btn-elevate-air',
                        'target' => '_blank'
                    ]) ?>
                <?php endif; ?>
                <?php if (!($type === FileTypeHelper::TYPE_LINK || $type === FileTypeHelper::TYPE_STATIC_TEXT)): ?>
                    <?= Html::a('<i class="la la-download"></i>&nbsp;Unduh', [
                        $controller . '/download-detail',
                        'kriteria' => $kriteria,
                        'dokumen' => $v->id,
                        'lk' => $lkProdi->id,
                        'jenis' => $jenis,
                        'prodi' => $prodi->id
                    ], ['class' => 'btn btn-warning btn-sm btn-pill btn-elevate btn-elevate-air']) ?>
                <?php endif; ?>
                <?php if ($untuk === 'isi'): ?>
                    <?= Html::a('<i class ="la la-trash"></i>&nbsp; Hapus', [$controller . '/hapus-detail'], [
                        'class' => 'btn btn-danger btn-sm btn-pill btn-elevate btn-elevate-air',
                        'data' => [
                            'method' => 'POST',
                            'confirm' => 'Apakah anda yakin menghapus item ini?',
                            'params' => [
                                'dokumen' => $v->id,
                                'kriteria' => $kriteria,
                                'prodi' => $prodi->id,
                                'lk' => $lkProdi->id,
                                'jenis' => $jenis
                            ]
                        ]
                    ]) ?>
                <?php endif ?>
                <?php
                if (Yii::$app->user->identity->role->item_name !== 'prodi'):
                    ?>
                    <?=Html::button('<i class="flaticon2-chat"></i> Komentar', ['value'=>\yii\helpers\Url::to([$controller . '/komentar','kriteria'=>$kriteria,'id'=>$v->id]),
                    'title'=>'Beri Komentar',
                    'class'=>'btn btn-brand btn-sm btn-pill btn-elevate btn-elevate-air showModalButton'
                ])?>
                    <?php if (!$v->is_verified): ?>
                        <?=Html::a('<i class="flaticon2-checkmark"></i> Setujui', [$controller . '/approve','kriteria'=>$kriteria,
                        'id'=>$v->id], [
                        'class'=>'btn btn-success btn-sm btn-pill btn-elevate btn-elevate-air',
                        'data'=>[
                            'method'=>'POST',
                            'confirm'=>'Apakah anda ingin menyetujui dokumen ini?'
                        ]
                    ])?>
                    <?php endif ?>
                <?php endif?>
            </div>

        </div>
    </td>
</tr>
<?php
$js = <<<JS
$(document).ajaxSuccess(function () {
    $("[data-toggle=kt-popover]").popover();
    $("[data-toggle=kt-tooltip]").tooltip();
});
JS;
$this->registerJs($js);
