<?php
/**
 * <code>
 * use PhpOffice\PhpWord\IOFactory;
 * use PhpOffice\PhpWord\PhpWord;
 * use PhpOffice\PhpWord\Settings as WordSettings;
 * use PhpOffice\PhpWord\Shared\Html;
 * use PhpOffice\PhpWord\TemplateProcessor;
 * use PhpOffice\PhpWord\Writer\Word2007\Element\Container;
 * use PhpOffice\Common\XMLWriter;
 *
 * $templateProcessor = new TemplateProcessor($template);
 * // let's get some xml content from our html
 * $phpWord = new PhpWord('Word2007');
 * // Adding an empty Section to the document...
 * $section = $phpWord->addSection();
 * Html::addHtml($section, $html, true, false);
 * $writer = IOFactory::createWriter($phpWord, 'Word2007');
 * // convert the html to "word2017" xml
 * $xmlWriter = new XMLWriter(XMLWriter::STORAGE_MEMORY, './', WordSettings::hasCompatibility());
 * $containerWriter = new Container($xmlWriter, $section);
 * $containerWriter->write();
 * $htmlAsXml = $xmlWriter->getData();
 *
 * // remplace our templateContent
 * WordSettings::setOutputEscapingEnabled(false);
 * $templateProcessor->setValue('content', $htmlAsXml);
 * WordSettings::setOutputEscapingEnabled(true);
 *
 * // Save the file :
 * $templateProcessor->saveAs($docxFilepath);
 *
 * ====================================================
 * use PhpOffice\PhpWord\PhpWord;
 * use PhpOffice\PhpWord\Settings;
 * use PhpOffice\PhpWord\SimpleType\TblWidth;
 * use PhpOffice\PhpWord\Style\Table;
 * use PhpOffice\PhpWord\TemplateProcessor;
 * use PhpOffice\PhpWord\Writer\Word2007\Element\Container;
 * use PhpOffice\Common\XMLWriter;
 *
 * //Solution to injet into templates without breaking things
 * function containerToXML($container){
 * $xmlWriter = new XMLWriter(XMLWriter::STORAGE_MEMORY, './', Settings::hasCompatibility());
 * $containerWriter = new Container($xmlWriter, $container);
 * $containerWriter->write();
 * return($xmlWriter->getData());
 * }
 *
 * //1st working template load and inject content via xml...
 * $templateProcessor = new TemplateProcessor("e:/the-template.docx");
 *
 * //Try and build xml from objects and insert xml instead...
 * $phpWord = new PhpWord();
 *
 * $fontStyle = array();//if no style given levels do not register (if empty array defaults to template)
 * $phpWord->addTitleStyle(1, $fontStyle);
 * $phpWord->addTitleStyle(2, $fontStyle);
 * $phpWord->addTitleStyle(3, $fontStyle);
 *
 * $section = $phpWord->addSection();
 * for($i=0;$i < 25;$i++){
 * $section->addText("Hello world $i");
 * }
 * //Table add test
 * $tbl = $section->addTable(array(
 * "layout" => Table::LAYOUT_AUTO,
 * "width"   => 100 * 50, //in word 1% == 50 unit (with in 1/50)
 * "unit"   => TblWidth::PERCENT
 * ));
 * $tbl->addRow(900, array('tblHeader' => true));
 * $tbl->addCell(150)->addText('Header1');
 * $tbl->addCell(150)->addText('Header2');
 * $tbl->addCell(150)->addText('Header3');
 * $tbl->addCell(150)->addText('Header4');
 * for($i=0;$i < 40;$i++){
 * $tbl->addRow();
 * $tbl->addCell(150)->addText("cell 1 row:$i");
 * $tbl->addCell(150)->addText("cell 2 row:$i");
 * $tbl->addCell(150)->addText("cell 3 row:$i");
 * $tbl->addCell(150)->addText("cell 4 row:$i");
 * }
 *
 * $section->addTitle('Level 1', 1);
 * $section->addTitle('Level 2', 2);
 * $section->addTitle('Level 3', 3);
 *
 * $elXml = containerToXML($section);
 *
 * // remplace our templateContent
 * Settings::setOutputEscapingEnabled(false);
 * $templateProcessor->setValue('content', $elXml);
 * Settings::setOutputEscapingEnabled(true);
 *
 * // Save the file :
 * $templateProcessor->saveAs("e:/demo-xml-inject.docx");
 * </code>
 */

namespace common\jobs;


use Carbon\Carbon;
use common\helpers\kriteria9\K9InstitusiDirectoryHelper;
use common\helpers\kriteria9\K9InstitusiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\models\kriteria9\led\institusi\K9InstitusiEksporDokumen;
use common\models\kriteria9\led\institusi\K9LedInstitusi;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Writer\Word2007\Element\Container;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;

class LedInstitusiPartialExportJob extends BaseObject implements JobInterface
{

    const JENIS_KRITERIA = 'kriteria';
    const JENIS_NONKRITERIA = 'nonkriteria';

    /** @var K9LedInstitusi */
    public $led;

    public $jenis;
    public $poinKriteria;

    /** @var TemplateProcessor */
    private $_document;

    /**
     * @param Queue $queue
     * @return mixed|void
     */
    public function execute($queue)
    {
        $now = Carbon::now()->timestamp;
        $namafile = '';
        $this->_document = new TemplateProcessor(K9InstitusiDirectoryHelper::getLedPartialTemplate());
        if ($this->jenis === self::JENIS_KRITERIA) {

            $namafile = $now . '-led-institusi-partial-kriteria' . $this->poinKriteria . '.docx';
            $this->isiKriteria($this->poinKriteria);
        } else {
            $namafile = $now . '-led-institusi-partial-poin' . $this->poinKriteria . '.docx';

            $this->isiNonKriteria($this->poinKriteria);
        }

        $model = new K9InstitusiEksporDokumen();
        $model->external_id = $this->led->id;
        $model->type = K9InstitusiEksporDokumen::TYPE_LED;
        $model->kode_dokumen = $this->poinKriteria;
        $model->bentuk_dokumen = 'docx';
        $model->nama_dokumen = $namafile;

        $path = K9InstitusiDirectoryHelper::getDokumenLedPath($this->led->akreditasiInstitusi);
        $this->_document->saveAs($path . '/' . $model->nama_dokumen);
        $model->save(false);


    }

    public function isiKriteria($kriteria)
    {
        $kriteriaAttr = 'k9LedInstitusiKriteria' . $kriteria . 's';
        $narasiAttr = 'k9LedInstitusiNarasiKriteria' . $kriteria . 's';
        $excludeAttr = 'id_led_institusi_kriteria' . $kriteria;
        $narasi = $this->led->$kriteriaAttr->$narasiAttr;

        $json = K9InstitusiJsonHelper::getJsonKriteriaLed($kriteria);
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $fontStyle = array();//if no style given levels do not register (if empty array defaults to template)
        $phpWord->addTitleStyle(1, $fontStyle);
        $phpWord->addTitleStyle(2, $fontStyle);
        $phpWord->addTitleStyle(3, $fontStyle);

        $teks = '<body>';

        $this->_document->setValue('kriteria', 'C.' . $kriteria);
        $this->_document->setValue('judul', $json->nama);
        foreach ($json->butir as $butir) {

            if ($butir->butir) {
                $teks .= "<h3>" . $butir->nomor . ". " . $butir->nama . "</h3>";
                foreach ($butir->butir as $item) {
                    $teks .= "<h3>" . $item->nomor . ". " . $item->nama . "</h3>";
                    $attr = NomorKriteriaHelper::changeToDbFormat($item->nomor);
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
        $this->_document->setValue('isi_kriteria_block', $htmlAsXml);
        Settings::setOutputEscapingEnabled(true);

    }

    public function isiNonKriteria($poin)
    {
        $narasi = null;
        $json = null;

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
                $json = K9InstitusiJsonHelper::getJsonLedKondisiEksternal();
                $attr = NomorKriteriaHelper::changeToDbFormat($json->nomor);
                $teks .= $narasi->$attr;
                break;
            case 'B':
                $narasi = $this->led->narasiProfil;
                $json = K9InstitusiJsonHelper::getJsonLedProfil();
                foreach ($json->butir as $butir) {

                    $teks .= "<h3>" . $butir->nomor . ". " . $butir->nama . "</h3>";
                    $attr = NomorKriteriaHelper::changeToDbFormat($butir->nomor);
                    $teks .= $narasi->$attr;
                    $teks .= "<br/>";
                }
                break;
            case 'D':
                $narasi = $this->led->narasiAnalisis;
                $json = K9InstitusiJsonHelper::getJsonLedAnalisis();
                foreach ($json->butir as $butir) {

                    $teks .= "<h3>" . $butir->nomor . ". " . $butir->nama . "</h3>";
                    $attr = NomorKriteriaHelper::changeToDbFormat($butir->nomor);
                    $teks .= $narasi->$attr;
                    $teks .= "<br/>";
                }
                break;
        }
        $teks .= '</body>';

        $this->_document->setValue('kriteria', $poin);
        $this->_document->setValue('judul', $json->nama);
        Html::addHtml($section, $teks, true, false);
        $htmlAsXml = $this->containerToXML($section);

        Settings::setOutputEscapingEnabled(false);
        $this->_document->setValue('isi_kriteria_block', $htmlAsXml);
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
