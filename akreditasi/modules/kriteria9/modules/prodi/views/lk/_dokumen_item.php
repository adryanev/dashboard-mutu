<?php
/**
 * @var $this yii\web\View
 */

use common\helpers\FileIconHelper;
use common\helpers\FileTypeHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

$controller = $this->context->id;
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
                <?= $v->nama_dokumen . ' (' . $v->isi_dokumen . ')' ?>

            </div>
        </div>
    </td>
    <td>
        <div class="row pull-right">
            <div class="col-lg-12">
                <?php $type = FileTypeHelper::getType($v->bentuk_dokumen);
                if ($type !== FileTypeHelper::TYPE_LINK):?>
                    <?php Modal::begin([
                        'id' => 'lihat-' . $v->id,
                        'title' => $v->nama_dokumen,
                        'toggleButton' => [
                            'label' => '<i class="la la-eye"></i> &nbsp;Lihat',
                            'class' => 'btn btn-info btn-sm btn-pill btn-elevate btn-elevate-air'
                        ],
                        'size' => 'modal-xl',
                        'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true],
                        'closeButton' => false,
                    ]); ?>
                    <?php switch ($type) {
                        case FileTypeHelper::TYPE_IMAGE:
                            echo Html::img("$path/sumber/{$v->isi_dokumen}", ['height' => '100%', 'width' => '100%']);
                            break;
                        case FileTypeHelper::TYPE_STATIC_TEXT:
                            echo $v->isi_dokumen;
                            break;
                        default:
                            echo '  <p><small>Jika dokumen tidak tampil, silahkan klik' . Html::a('di sini.',
                                    'https://docs.google.com/gview?url=' . $path . '/' . $jenis . '/' . rawurlencode($v->isi_dokumen),
                                    ['target' => '_blank']) . '</small>
                </p>';
                            echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://docs.google.com/gview?url=' . $path . '/' . $jenis . '/' . rawurlencode($v->isi_dokumen) . '&embedded=true"></iframe></div>';
                            break;
                    } ?>
                    <?php Modal::end(); ?>
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
            </div>

        </div>
    </td>
</tr>
