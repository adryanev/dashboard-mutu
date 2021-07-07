<?php


namespace common\jobs;

use Carbon\Carbon;
use common\helpers\kriteria9\K9InstitusiDirectoryHelper;
use common\models\kriteria9\kuantitatif\institusi\K9DataKuantitatifInstitusi;
use common\models\kriteria9\lk\institusi\K9LkInstitusi;
use common\models\ProfilInstitusi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\DomCrawler\Crawler;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\queue\JobInterface;

class KuantitatifPTVokasiExportJob extends BaseObject implements JobInterface
{
    use KuantitatifPerguruanTinggiTrait;


    /** @var K9LkInstitusi */
    public $lk;
    public $template;

    public function execute($queue)
    {

        $reader = IOFactory::createReader('Xlsx');
        $this->spreadsheet = $reader->load($this->template);
        $this->export($queue);
    }

    private function export($queue)
    {
        $akreditasiInstitusi = $this->lk->akreditasiInstitusi;
        $institusi = ArrayHelper::map(ProfilInstitusi::find()->all(), 'nama', 'isi');

        $this->isiProfil($institusi);
        $this->tabel1();
        $this->tabel2();
        $this->tabel3();
        $this->tabel4();
        $this->tabel5();


        $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');

        $timestamp = Carbon::now()->timestamp;
        $filename = "$timestamp-matriks-kuantitatif-institusi.xlsx";


        $path = K9InstitusiDirectoryHelper::getKuantitatifPath($akreditasiInstitusi);
        $writer->save("$path/$filename");

        $model = K9DataKuantitatifInstitusi::findOne([
            'id_akreditasi_institusi' => $akreditasiInstitusi->id,
            'sumber' => K9DataKuantitatifInstitusi::SUMBER_EKSPOR
        ]);
        if (!$model) {
            $model = new K9DataKuantitatifInstitusi();
            $model->id_akreditasi_institusi = $akreditasiInstitusi->id;
            $model->sumber = K9DataKuantitatifInstitusi::SUMBER_EKSPOR;
        } else {
            $oldName = $model->isi_dokumen;
            FileHelper::unlink("$path/$oldName");
        }
        $model->nama_dokumen = 'Matriks Kuantitatif Institusi ' . '(' . $akreditasiInstitusi->akreditasi->tahun . ')';
        $model->isi_dokumen = $filename;
        $model->save(false);
    }

    private function tabel1()
    {
        //get Kriteria 1 LK
        $tabel = $this->lk->k9LkInstitusiKriteria1s->k9LkInstitusiKriteria1Narasi;

        //1.a-1
        $crawler = new Crawler($tabel->_1_a__1);
        $data = $this->filter($crawler);
        $startRow = 15;
        $currentRow = 15;
        $currentWorksheet = 2;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6]);

            $currentRow++;
        }

        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);


        //1.a-2
        $crawler = new Crawler($tabel->_1_a__2);
        $data = $this->filter($crawler);

        $startRow = 8;
        $currentRow = 8;
        $currentWorksheet = 3;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5]);

            $currentRow++;
        }

        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);


        //1.a-3
        $crawler = new Crawler($tabel->_1_a__3);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 4;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);

            $currentRow++;
        }

        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //1.b
        $crawler = new Crawler($tabel->_1_b);
        $data = $this->filter($crawler);

        $startRow = 7;
        $currentRow = 7;
        $currentWorksheet = 5;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7])
                ->setCellValue('I' . $currentRow, $item[8])
                ->setCellValue('J' . $currentRow, $item[9])
                ->setCellValue('K' . $currentRow, $item[10])
                ->setCellValue('L' . $currentRow, $item[11])
                ->setCellValue('M' . $currentRow, $item[12])
                ->setCellValue('N' . $currentRow, $item[13]);

            $currentRow++;
        }

        //1.c
        $crawler = new Crawler($tabel->_1_c);
        $data = $this->filter($crawler);

        $startRow = 14;
        $currentRow = 14;
        $currentWorksheet = 6;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7] ?? '');

            $currentRow++;
        }

        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

    }

    private function tabel2()
    {
        // Kriteria2 Narasi LK
        $tabel = $this->lk->k9LkInstitusiKriteria2s->k9LkInstitusiKriteria2Narasi;


        //2a
        $crawler = new Crawler($tabel->_2_a);
        $data = $this->filter($crawler);

        $startRow = 7;
        $currentRow = 7;
        $currentWorksheet = 7;

        foreach ($data as $k => $item) {
            if ($k === 0 || $k === 6 || $k === 7 || $k === 13 || $k === 14 || $k === 20 || $k === 21 || $k === 27 || $k === 28 || $k === 34 || $k === 35 || $k === 41 || $k === 42 || $k === 48 || $k === 49 || $k === 55 || $k === 56) {
                $currentRow++;
                continue;
            }
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7]);
            $currentRow++;
        }


        //2.b
        $crawler = new Crawler($tabel->_2_b);
        $data = $this->filter($crawler);

        array_pop($data);
        $startRow = 5;
        $currentRow = 5;
        $currentWorksheet = 8;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);

            $currentRow++;
        }

        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //2.c
        $crawler = new Crawler($tabel->_2_c);
        $data = $this->filter($crawler);

        array_pop($data);
        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 9;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5]);

            $currentRow++;
        }

        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);
    }

    private function tabel3()
    {
        //narasi
        $tabel = $this->lk->k9LkInstitusiKriteria3s->k9LkInstitusiKriteria3Narasi;

        //3a1
        $crawler = new Crawler($tabel->_3_a_1);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 10;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //3a2
        $crawler = new Crawler($tabel->_3_a_2);
        $data = $this->filter($crawler);
        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 11;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7]);
            $currentRow++;
        }

        //3a3
        $crawler = new Crawler($tabel->_3_a_3);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 5;
        $currentRow = 5;
        $currentWorksheet = 12;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //3a4
        $crawler = new Crawler($tabel->_3_a_4);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 13;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6]);
            $currentRow++;
        }

        //3b
        $crawler = new Crawler($tabel->_3_b);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 5;
        $currentRow = 5;
        $currentWorksheet = 14;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //3c1
        $crawler = new Crawler($tabel->_3_c_1);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 15;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }


        //3c2
        $crawler = new Crawler($tabel->_3_c_2);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 16;

        foreach ($data as $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }


        //3d
        $crawler = new Crawler($tabel->_3_d);
        $data = $this->filter($crawler);

        $startRow = 7;
        $currentRow = 7;
        $currentWorksheet = 17;

        foreach ($data as $item) {

            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

    }

    private function tabel4()
    {
        $tabel = $this->lk->k9LkInstitusiKriteria4s->k9LkInstitusiKriteria4Narasi;

        //4a
        $crawler = new Crawler($tabel->_4_a);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 18;

        foreach ($data as $k => $item) {
            if (false !== strpos($item[1], "Jumlah")) {
                $currentRow++;
                continue;
            }

//            if ($k === 3 || $k === 9 || $k === 14 || $k === 18 || $k === 19 || $k === 22 || $k === 23) {
//                $currentRow++;
//                continue;
//            }

            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5]);
            $currentRow++;
        }

        //4b
        $crawler = new Crawler($tabel->_4_b);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 19;

        foreach ($data as $k => $item) {
            if (false !== strpos($item[1], "Jumlah")) {
                $currentRow++;
                continue;
            }
//            if ($k === 7 || $k === 10) {
//                $currentRow++;
//                continue;
//            }

            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }
    }

    private function tabel5()
    {
        $tabel = $this->lk->k9LkInstitusiKriteria5s->k9LkInstitusiKriteria5Narasi;

        //5a1
        $crawler = new Crawler($tabel->_5_a_1);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 20;

        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);

            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7])
                ->setCellValue('I' . $currentRow, $item[8]);
            $currentRow++;
        }
        //5a2
        $crawler = new Crawler($tabel->_5_a_2);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 21;

        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);


        //5b1
        $crawler = new Crawler($tabel->_5_b_1);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 10;
        $currentRow = 10;
        $currentWorksheet = 22;

        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //5b2
        $crawler = new Crawler($tabel->_5_b_2);
        $data = $this->filter($crawler);
        array_pop($data);


        $startRow = 10;
        $currentRow = 10;
        $currentWorksheet = 23;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //5c1
        $crawler = new Crawler($tabel->_5_c_1);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 24;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7]);
            $currentRow++;
        }

        //5c2a
        $crawler = new Crawler($tabel->_5_c_2_a);
        $data = $this->filter($crawler);

        $startRow = 8;
        $currentRow = 8;
        $currentWorksheet = 25;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7])
                ->setCellValue('I' . $currentRow, $item[8]);
            $currentRow++;
        }

        //5c2b
        $crawler = new Crawler($tabel->_5_c_2_b);
        $data = $this->filter($crawler);

        $startRow = 21;
        $currentRow = 21;
        $currentWorksheet = 25;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5]);
            $currentRow++;
        }

        //5c2c1
        $crawler = new Crawler($tabel->_5_c_2_c_1);
        $data = $this->filter($crawler);

        $startRow = 31;
        $currentRow = 31;
        $currentWorksheet = 25;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }

        //5c2c2
        $crawler = new Crawler($tabel->_5_c_2_c_2);
        $data = $this->filter($crawler);

        $startRow = 39;
        $currentRow = 39;
        $currentWorksheet = 25;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }

        //5c2d
        $crawler = new Crawler($tabel->_5_c_2_d);
        $data = $this->filter($crawler);

        $startRow = 48;
        $currentRow = 48;
        $currentWorksheet = 25;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7])
                ->setCellValue('I' . $currentRow, $item[8]);
            $currentRow++;
        }

        //5c2e
        $crawler = new Crawler($tabel->_5_c_2_e);
        $data = $this->filter($crawler);

        $startRow = 61;
        $currentRow = 61;
        $currentWorksheet = 25;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6]);
            $currentRow++;
        }
        //5c2f
        $crawler = new Crawler($tabel->_5_c_2_f);
        $data = $this->filter($crawler);

        $startRow = 72;
        $currentRow = 72;
        $currentWorksheet = 25;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }

        //5c2g
        $crawler = new Crawler($tabel->_5_c_2_g);
        $data = $this->filter($crawler);

        $startRow = 81;
        $currentRow = 81;
        $currentWorksheet = 25;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }

        //5d15d25e2-ref
        $crawler = new Crawler($tabel->_5_d_1__5_d_2__5_e_2__ref);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 26;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7]);
            $currentRow++;
        }

        //5d1
        $crawler = new Crawler($tabel->_5_d_1);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 27;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }
        //5d2
        $crawler = new Crawler($tabel->_5_d_2);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 28;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }

        //5e1__ref
        $crawler = new Crawler($tabel->_5_e_1__ref);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 29;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5])
                ->setCellValue('G' . $currentRow, $item[6])
                ->setCellValue('H' . $currentRow, $item[7]);
            $currentRow++;
        }

        //5e1
        $crawler = new Crawler($tabel->_5_e_1);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 30;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5]);
            $currentRow++;
        }

        //5e2
        $crawler = new Crawler($tabel->_5_e_2);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 31;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4])
                ->setCellValue('F' . $currentRow, $item[5]);
            $currentRow++;
        }

        //5f
        $crawler = new Crawler($tabel->_5_f);
        $data = $this->filter($crawler);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 32;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3])
                ->setCellValue('E' . $currentRow, $item[4]);
            $currentRow++;
        }

        //5g
        $crawler = new Crawler($tabel->_5_g);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 5;
        $currentRow = 5;
        $currentWorksheet = 33;
        foreach ($data as $k => $item) {
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //5h1
        $crawler = new Crawler($tabel->_5_h__1);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 34;
        foreach ($data as $k => $item) {
            if ($k === 0) {
                $currentRow++;
                continue;
            }
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //5h2
        $crawler = new Crawler($tabel->_5_h__2);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 35;
        foreach ($data as $k => $item) {
            if ($k === 0) {
                $currentRow++;
                continue;
            }
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);

        //5h3
        $crawler = new Crawler($tabel->_5_h__3);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 36;
        foreach ($data as $k => $item) {
            if ($k === 0) {
                $currentRow++;
                continue;
            }
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);


        //5h4
        $crawler = new Crawler($tabel->_5_h__4);
        $data = $this->filter($crawler);
        array_pop($data);

        $startRow = 6;
        $currentRow = 6;
        $currentWorksheet = 37;
        foreach ($data as $k => $item) {
            if ($k === 0) {
                $currentRow++;
                continue;
            }
            $this->spreadsheet->getSheet($currentWorksheet)->insertNewRowBefore($currentRow + 1, 1);
            $this->spreadsheet->getSheet($currentWorksheet)
                ->setCellValue('A' . $currentRow, $item[0])
                ->setCellValue('B' . $currentRow, $item[1])
                ->setCellValue('C' . $currentRow, $item[2])
                ->setCellValue('D' . $currentRow, $item[3]);
            $currentRow++;
        }
        $this->spreadsheet->getSheet($currentWorksheet)->removeRow($currentRow, 2);


    }

    protected function filter($crawler)
    {
        return $crawler->filter('tbody')->filter('tr')->each(function ($tr, $i) {
            return $tr->filter('td')->each(function ($td, $i) {
                return trim($td->text());
            });
        });
    }

}
