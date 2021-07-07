<?php


namespace common\jobs;


use Carbon\Carbon;
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\models\kriteria9\led\prodi\K9LedProdi;
use common\models\kriteria9\led\prodi\K9ProdiEksporDokumen;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Writer\Word2007\Element\Container;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;

class LedProdiCompleteExportJob extends BaseObject implements JobInterface
{

    /**
     * @var K9LedProdi
     */
    public $led;

    /**
     * @var TemplateProcessor
     */
    private $_document;

    /**
     * @param Queue $queue
     * @return mixed|void
     */
    public function execute($queue)
    {
        $timestamp = Carbon::now()->timestamp;
        $this->_document = new TemplateProcessor(K9ProdiDirectoryHelper::getLedCompleteTemplate());

        $namafile = $timestamp . '-led-prodi-complete.docx';

        $this->isiDokumen();
        $model = new K9ProdiEksporDokumen();
        $model->external_id = $this->led->id;
        $model->type = K9ProdiEksporDokumen::TYPE_LED;
        $model->kode_dokumen = 'complete';
        $model->bentuk_dokumen = 'docx';
        $model->nama_dokumen = $namafile;

        $path = K9ProdiDirectoryHelper::getDokumenLedPath($this->led->akreditasiProdi);
        $this->_document->saveAs($path . '/' . $model->nama_dokumen);
        $model->save(false);

    }

    private function isiDokumen()
    {

        $this->isiNonKriteria('A');
        $this->isiNonKriteria('B');
        for ($i = 1; $i <= 9; $i++) {
            $this->isiKriteria($i);
        }
        $this->isiNonKriteria('D');

    }

    private function isiNonKriteria($poin)
    {
        $narasi = null;
        $json = null;
        $jenis = '';

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $fontStyle = array();//if no style given levels do not register (if empty array defaults to template)
        $phpWord->addTitleStyle(1, $fontStyle);
        $phpWord->addTitleStyle(2, $fontStyle);
        $phpWord->addTitleStyle(3, $fontStyle);

        $teks = '<body>';

        switch ($poin) {
            case 'A':
                $narasi = $this->led->narasiEksternal;
                $json = K9ProdiJsonHelper::getJsonLedKondisiEksternal();
                $attr = NomorKriteriaHelper::changeToDbFormat($json->nomor);
                $teks .= $narasi->$attr;
                $jenis = 'eksternal';
                break;
            case 'B':
                $narasi = $this->led->narasiProfil;
                $json = K9ProdiJsonHelper::getJsonLedProfil();
                foreach ($json->butir as $butir) {

                    $teks .= "<h3>" . $butir->nomor . ". " . $butir->nama . "</h3>";
                    $attr = NomorKriteriaHelper::changeToDbFormat($butir->nomor);
                    $teks .= $narasi->$attr;
                    $teks .= "<br/>";
                }
                $jenis = 'profil';
                break;
            case 'D':
                $narasi = $this->led->narasiAnalisis;
                $json = K9ProdiJsonHelper::getJsonLedAnalisis();
                foreach ($json->butir as $butir) {

                    $teks .= "<h4>" . $butir->nomor . ". " . $butir->nama . "</h4>";
                    $attr = NomorKriteriaHelper::changeToDbFormat($butir->nomor);
                    $teks .= $narasi->$attr;
                    $teks .= "<br/>";
                }
                $jenis = 'analisis';
                break;
        }
        $teks .= '</body>';

        Html::addHtml($section, $teks, true, false);
        $htmlAsXml = $this->containerToXML($section);

        Settings::setOutputEscapingEnabled(false);
        $this->_document->setValue('isi_' . $jenis, $htmlAsXml);
        Settings::setOutputEscapingEnabled(true);
    }

    private function isiKriteria($kriteria)
    {
        $kriteriaAttr = 'k9LedProdiKriteria' . $kriteria . 's';
        $narasiAttr = 'k9LedProdiNarasiKriteria' . $kriteria . 's';
        $excludeAttr = 'id_led_prodi_kriteria' . $kriteria;
        $narasi = $this->led->$kriteriaAttr->$narasiAttr;

        $json = K9ProdiJsonHelper::getJsonKriteriaLed($kriteria);
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $fontStyle = array();//if no style given levels do not register (if empty array defaults to template)
        $phpWord->addTitleStyle(1, $fontStyle);
        $phpWord->addTitleStyle(2, $fontStyle);
        $phpWord->addTitleStyle(3, $fontStyle);

        $teks = '<body>';
        foreach ($json->butir as $butir) {

            if ($butir->butir) {
                $teks .= "<h3>" . $butir->nomor . ". " . $butir->nama . "</h3>";

                foreach ($butir->butir as $butir2) {

                    $teks .= "<h4>" . $butir2->nomor . ". " . $butir2->nama . "</h4>";
                    $attr = NomorKriteriaHelper::changeToDbFormat($butir2->nomor);
                    $teks .= $narasi->$attr;
                    $teks .= "<br/>";

                }
                continue;
            }


            $teks .= "<h3>" . $butir->nomor . ". " . $butir->nama . "</h3>";
            $attr = NomorKriteriaHelper::changeToDbFormat($butir->nomor);
            $teks .= $narasi->$attr;
            $teks .= "<br/>";


        }
        $teks .= '</body>';
        Html::addHtml($section, $teks, true, false);
        $htmlAsXml = $this->containerToXML($section);

        Settings::setOutputEscapingEnabled(false);
        $this->_document->setValue('isi_kriteria_' . $kriteria, $htmlAsXml);
        Settings::setOutputEscapingEnabled(true);
    }

    function containerToXML(/** @var  Container */ $container)
    {
        $xmlWriter = new XMLWriter(XMLWriter::STORAGE_MEMORY, './', Settings::hasCompatibility());
        $containerWriter = new Container($xmlWriter, $container);
        $containerWriter->write();
        return ($xmlWriter->getData());
    }
}
