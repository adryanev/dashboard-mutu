<?php
/**
 * @var $this yii\web\View
 */

use yii\bootstrap4\Html;

?>

<p><small>Jika dokumen tidak tampil, silahkan klik <?= Html::a('di sini.',
            'https://docs.google.com/gview?url=' . $path . '/' . rawurlencode($model->isi_dokumen),
            ['target' => '_blank']) ?></small>
</p> <?php echo ' <div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://docs.google.com/gview?url=' . $path . '/' . rawurlencode($model->isi_dokumen) . '&embedded=true"></iframe></div>'; ?>
