<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 8/26/2019
 * Time: 1:54 PM
 */

/**
 * @var $this View
 * @var $led K9LedProdi
 * @var $dataDokumen [];
 * @var $json Led;
 * @var $kriteria [];
 * @var $path string
 * @var $json_eksternal common\models\kriteria9\led\Led
 * @var $json_profil common\models\kriteria9\led\Led
 * @var $json_analisis common\models\kriteria9\led\Led
 * @var $modelEksternal common\models\kriteria9\led\prodi\K9LedProdiNarasiKondisiEksternal
 * @var $modelAnalisis common\models\kriteria9\led\prodi\K9LedProdiNarasiAnalisis
 * @var $modelProfil common\models\kriteria9\led\prodi\K9LedProdiNarasiProfilUpps
 * @var $prodi common\models\ProgramStudi
 * @var $untuk string
 */

use common\models\kriteria9\led\Led;
use common\models\kriteria9\led\prodi\K9LedProdi;
use yii\helpers\StringHelper;
use yii\web\View;

$this->title = StringHelper::mb_ucfirst($untuk) . " LED";
$this->params['breadcrumbs'][] = ['label' => 'Beranda', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = ['label' => 'Asesor', 'url' => ['/asesor/default/index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<?= $this->render('@akreditasi/modules/kriteria9/modules/prodi/views/led/_info_akreditasi', compact('led')) ?>


<?= $this->render('@akreditasi/modules/kriteria9/modules/prodi/views/led/_dokumen_led',
    compact('modelDokumen', 'dataDokumen', 'path', 'prodi', 'untuk')) ?>

<?= $this->render('@akreditasi/modules/kriteria9/modules/prodi/views/led/_tabel_led', [
    'kriteria' => $kriteria,
    'json' => $json,
    'prodi' => $prodi,
    'untuk' => $untuk,
    'led' => $led,
    'json_eksternal' => $json_eksternal,
    'json_profil' => $json_profil,
    'json_analisis' => $json_analisis,
    'modelEksternal' => $modelEksternal,
    'modelAnalisis' => $modelAnalisis,
    'modelProfil' => $modelProfil,
]) ?>

