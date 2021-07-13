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
use common\helpers\kriteria9\K9ProdiDirectoryHelper;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\helpers\NomorKriteriaHelper;
use common\models\kriteria9\led\prodi\K9ProdiEksporDokumen;
use common\models\kriteria9\lk\prodi\K9LkProdi;
use common\models\kriteria9\lk\TabelLk;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Writer\Word2007\Element\Container;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;

class LkProdiPartialExportJob extends BaseObject implements JobInterface
{

    /** @var K9LkProdi */
    public $lk;
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
        $this->_document = new TemplateProcessor(K9ProdiDirectoryHelper::getLkPartialTemplate());


        $namafile = $now . '-lk-prodi-partial-kriteria' . $this->poinKriteria . '.docx';
        $this->isiKriteria($this->poinKriteria);


        $model = new K9ProdiEksporDokumen();
        $model->external_id = $this->lk->id;
        $model->type = K9ProdiEksporDokumen::TYPE_LK;
        $model->kode_dokumen = $this->poinKriteria;
        $model->bentuk_dokumen = 'docx';
        $model->nama_dokumen = $namafile;

        $path = K9ProdiDirectoryHelper::getDokumenLkPath($this->lk->akreditasiProdi);
        $this->_document->saveAs($path . '/' . $model->nama_dokumen);
        $model->save(false);


    }

    public function isiKriteria($kriteria)
    {
        $kriteriaAttr = 'k9LkProdiKriteria' . $kriteria . 's';
        $narasiAttr = 'k9LkProdiKriteria' . $kriteria . 'Narasi';
        $narasi = $this->lk->$kriteriaAttr->$narasiAttr;

        $json = K9ProdiJsonHelper::getJsonKriteriaLk($kriteria, $this->lk->akreditasiProdi->prodi->jenjang);
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $fontStyle = array();//if no style given levels do not register (if empty array defaults to template)
        $phpWord->addTitleStyle(1, $fontStyle);
        $phpWord->addTitleStyle(2, $fontStyle);
        $phpWord->addTitleStyle(3, $fontStyle);

        $teks = '<body>';

        $this->_document->setValue('tabel', $kriteria);
        $this->_document->setValue('judul', $json->judul);
        foreach ($json->butir as /** @var $butir TabelLk */ $butir) {
            $teks .= "<h3>" . $butir->tabel . ". " . $butir->nama . "</h3>";
            $attr = NomorKriteriaHelper::changeToDbFormat($butir->tabel);
            $teks .= $narasi->$attr;
            $teks .= "<br/>";


        }
        $teks .= '</body>';
        Html::addHtml($section, $teks, true, false);
        $htmlAsXml = $this->containerToXML($section);

        Settings::setOutputEscapingEnabled(false);
        $this->_document->setValue('isi_tabel_block', $htmlAsXml);
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
