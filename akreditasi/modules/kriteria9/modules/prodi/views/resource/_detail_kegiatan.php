<?php
 /**
  * @var $model common\models\unit\KegiatanUnitDetail
  * @var $url string
  */

use common\helpers\FileTypeHelper;
use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;



?>
<div class="row">
    <div class="col-lg-12">
        <?php

        $type = FileTypeHelper::getType($model->bentuk_file);
        if ($type === FileTypeHelper::TYPE_IMAGE || $type === FileTypeHelper::TYPE_PDF):
            switch ($type) {
                case FileTypeHelper::TYPE_IMAGE:
                    echo Html::img("$url/{$model->isi_file}", ['height' => '100%', 'width' => '100%']);
                    break;
                case FileTypeHelper::TYPE_STATIC_TEXT:
                    echo $model->isi_file;
                    break;
                case FileTypeHelper::TYPE_PDF:
                    echo '<embed src="' . $url . '/' . $model->isi_file . '" type="application/pdf" height="100%" width="100%">
';
                    break;
            }

            ?>
        <?php else:?>
            <?= Html::a('<i class="la la-download"></i>&nbsp;Unduh', ['resource/download-detail-kegiatan', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm btn-pill btn-elevate btn-elevate-air']) ?>

        <?php endif?>

    </div>
</div>
