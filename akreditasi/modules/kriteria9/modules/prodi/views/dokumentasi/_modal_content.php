<?php
/**
 * @var $model common\models\kriteria9\dokumentasi\prodi\DokumentasiProdi
 * @var $path string
 */

use common\helpers\FileTypeHelper;
use yii\bootstrap4\Html;

$type = FileTypeHelper::getType($model->bentuk_dokumen);
switch ($type) {
    case FileTypeHelper::TYPE_IMAGE:
        echo Html::img("$path/{$model->isi_dokumen}",
            ['height' => '100%', 'width' => '100%']);
        break;
    case FileTypeHelper::TYPE_STATIC_TEXT:
        echo $model->isi_dokumen;
        break;
    default:
        echo '  <p><small>Jika dokumen tidak tampil, silahkan klik ' . Html::a('di sini.',
                'https://docs.google.com/gview?url=' . $path . '/' . rawurlencode($model->isi_dokumen),
                ['target' => '_blank']) . '</small>
                </p>';
        echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://docs.google.com/gview?url=' . $path . '/' . rawurlencode($model->isi_dokumen) . '&embedded=true"></iframe></div>';
        break;
}
