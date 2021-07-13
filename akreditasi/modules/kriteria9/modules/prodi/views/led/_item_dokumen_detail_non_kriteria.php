<?php
/**
 * @var $this yii\web\View
 * @var $nomor int
 * @var $path string
 * @var $jenis string
 * @var $prodi
 * @var $detail
 * @var $poin
 */

use common\helpers\FileIconHelper;
use common\helpers\FileTypeHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

$controller = $this->context->id;
?>
<tr>
    <td><?= $nomor ?></td>
    <td>
        <div class="row">
            <div class="col-lg-12 text-center">

                <?= FileIconHelper::getIconByExtension($detail->bentuk_dokumen) ?>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php $type = FileTypeHelper::getType($detail->bentuk_dokumen);

                if ($type === FileTypeHelper::TYPE_STATIC_TEXT || $type === FileTypeHelper::TYPE_LINK) : ?>
                    <?= Html::encode($detail->nama_dokumen) ?>

                <?php else: ?>
                    <?= $detail->nama_dokumen . ' (' . $detail->isi_dokumen . ')' ?>
                <?php endif; ?>

            </div>
        </div>
    </td>
    <td class="pull-right">
        <div class="row">
            <div class="col-lg-12">
                <?php $type = FileTypeHelper::getType($detail->bentuk_dokumen);
                if ($type !== FileTypeHelper::TYPE_LINK):?>

                    <?php Modal::begin([
                        'title' => $detail->nama_dokumen,
                        'toggleButton' => [
                            'label' => '<i class="la la-eye"></i> &nbsp;Lihat',
                            'class' => 'btn btn-info btn-sm btn-pill btn-elevate btn-elevate-air'
                        ],
                        'size' => 'modal-xl',
                        'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true],
                        'closeButton' => false,
                        'id' => 'dokumen-lainnya-' . $detail->id,
                    ]); ?>
                    <?php switch ($type) {
                        case FileTypeHelper::TYPE_IMAGE:
                            echo Html::img("$path/{$jenis}/{$detail->isi_dokumen}",
                                ['height' => '100%', 'width' => '100%']);
                            break;
                        case FileTypeHelper::TYPE_STATIC_TEXT:
                            echo $detail->isi_dokumen;
                            break;
                        default:
                            echo '  <p><small>Jika dokumen tidak tampil, silahkan klik ' . Html::a('di sini.',
                                    'https://docs.google.com/gview?url=' . $path . '/' . $jenis . '/' . rawurlencode($detail->isi_dokumen),
                                    ['target' => '_blank']) . '</small>
                </p>';
                            echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://docs.google.com/gview?url=' . $path . '/' . $jenis . '/' . rawurlencode($detail->isi_dokumen) . '&embedded=true"></iframe></div>';
                            break;
                    } ?>
                    <?php Modal::end(); ?>
                <?php else: ?>
                    <?= Html::a('<i class="la la-external-link"></i> Lihat', $detail->isi_dokumen, [
                        'class' => 'btn btn-info btn-sm btn-pill btn-elevate btn-elevate-air',
                        'target' => '_blank'
                    ]) ?>
                <?php endif; ?>
                <?php if ($type === FileTypeHelper::TYPE_LINK || $type === FileTypeHelper::TYPE_STATIC_TEXT): ?>

                <?php else: ?>
                    <?= Html::a('<i class="la la-download"></i>&nbsp;Unduh', [
                        $controller . '/download-detail-non-kriteria',
                        'poin' => $poin,
                        'dokumen' => $detail->id,
                        'led' => $led->id,
                        'jenis' => $jenis
                    ], ['class' => 'btn btn-warning btn-sm btn-pill btn-elevate btn-elevate-air']) ?>
                <?php endif; ?>
                <?php if ($untuk === 'isi'): ?>
                    <?= Html::a('<i class ="la la-trash"></i>&nbsp; Hapus',
                        [$controller . '/hapus-detail-non-kriteria'], [
                            'class' => 'btn btn-danger btn-sm btn-pill btn-elevate btn-elevate-air',
                            'data' => [
                                'method' => 'POST',
                                'confirm' => 'Apakah anda yakin menghapus item ini?',
                                'params' => [
                                    'dokumen' => $detail->id,
                                    'poin' => $poin,
                                    'prodi' => $prodi->id,
                                    'led' => $led->id,
                                    'jenis' => $jenis
                                ]
                            ]
                        ]) ?>
                <?php endif ?>
            </div>

        </div>
    </td>
</tr>
