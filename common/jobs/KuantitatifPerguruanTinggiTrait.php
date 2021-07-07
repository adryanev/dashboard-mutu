<?php


namespace common\jobs;


use PhpOffice\PhpSpreadsheet\Spreadsheet;

trait KuantitatifPerguruanTinggiTrait
{
    /**
     * @var Spreadsheet
     */
    private $spreadsheet;

    public function isiProfil($profil)
    {
        $currentWorksheet = 0;
        //nama pt
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H7', $profil['nama']);
        //bentuk pt
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H9', $profil['bentuk']);
        //jenis pengelolaan
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H16', $profil['jenis_pengelolaan']);
        //alamat
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H24', $profil['alamat']);
        //nomor telepon
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H28', $profil['nomor_telepon']);
        //email
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H30', $profil['email']);
        //website
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H32', $profil['website']);
        // nomor_sk_pendirian
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H34', $profil['nomor_sk_pendirian']);
        // tanggal_sk_pendirian
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H36', $profil['tanggal_sk_pendirian']);
        //peringkat_akreditasi_pt
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H38', $profil['peringkat_akreditasi_banpt']);
        //nomor_sk_banpt
        $this->spreadsheet->getSheet($currentWorksheet)->setCellValue('H40', $profil['nomor_sk_banpt']);

    }

}
