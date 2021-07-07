<?php


namespace common\helpers\kriteria9;


use common\models\Constants;
use yii\helpers\Json;

trait K9ProgressTrait
{

    /**
     * Membandingkan antara json dan data yang ada.
     * Tahap:
     * 1. Dapatkan data dari json.
     * 2. Hitung semua jumlah dokumen yang ada.
     * 3. Bandingkan jumlah dokumen dengan jumlah dokumen dengan nomor unique yang ada.
     * 4. Hitung perbedaannya dan return progress
     *
     * @param $dokumen
     * @param $kriteria
     * @param $filejson
     * @return float
     */
    static function hitung($dokumen,$kriteria,$filejson){

        $totalDokumenJson = 0;
        foreach ($filejson->butir as $butir) {

            $missing = 0;
            foreach ($butir->dokumen_sumber as $doksum) {
                if (empty($doksum->kode)) {
                    ++$missing;
                }
            }

            foreach ($butir->dokumen_pendukung as $dokpen) {
                if (empty($dokpen->kode)) {
                    ++$missing;
                }
            }

            $dataSumber = sizeof($butir->dokumen_sumber);
            $dataPendukung = sizeof($butir->dokumen_pendukung);
            $data = $dataSumber + $dataPendukung - $missing;
            $totalDokumenJson += $data;
        }

        $dokumenKriteria = $dokumen->select('kode_dokumen')->distinct()->andWhere(['jenis_dokumen' => Constants::SUMBER])->orWhere(['jenis_dokumen' => Constants::PENDUKUNG])->all();
        $totalDokumenKriteria = sizeof($dokumenKriteria);

        if ($totalDokumenJson === 0) {
            return 0;
        }

        return round((($totalDokumenKriteria / $totalDokumenJson) * 100), 2);
    }
}
