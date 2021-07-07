<?php


namespace common\helpers;

use common\models\Constants;

trait DownloadDokumenTrait
{

    public function download($model, $path, $file)
    {
        if ($model->jenis_dokumen === Constants::LAINNYA) {
            return "$path/lainnya/$file";
        }

        if ($model->jenis_dokumen === Constants::SUMBER) {
            return "$path/sumber/$file";
        }

        if ($model->jenis_dokumen === Constants::PENDUKUNG) {
            return "$path/pendukung/$file";
        }
    }
}
