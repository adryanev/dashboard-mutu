<?php
/**
 * @var $this yii\web\View
 * @var $untuk string
 * @var $led common\models\kriteria9\led\prodi\K9LedProdi
 * @var $json common\models\kriteria9\led\Led
 * @var $kriteria []
 * @var $prodi
 * @var $json_eksternal common\models\kriteria9\led\Led
 * @var $json_profil common\models\kriteria9\led\Led
 * @var $json_analisis common\models\kriteria9\led\Led
 * @var $modelEksternal common\models\kriteria9\led\prodi\K9LedProdiNarasiKondisiEksternal
 * @var $modelAnalisis common\models\kriteria9\led\prodi\K9LedProdiNarasiAnalisis
 * @var $modelProfil common\models\kriteria9\led\prodi\K9LedProdiNarasiProfilUpps
 */

use yii\bootstrap4\Html;
use yii\bootstrap4\Progress;

?>
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Laporan Evaluasi Program Studi
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-actions">
                <div class="pull-left ml-2 mr-2">
                    <?= Html::a('<i class="fas fa-file-word"></i> Ekspor', ['export-complete'],
                        [
                            'class' => 'btn btn-primary btn-elevate btn-elevate-air',
                            'data' => [
                                'method' => 'POST',
                                'confirm' => 'Apakah anda ingin mengekspor dokumen LED?',
                                'params' => [
                                    'referer' => \yii\helpers\Url::current(),
                                    'led' => $led->id,
                                ]
                            ]
                        ]) ?>
                </div>
                <div class="pull-right ml-2 mr-2">
                    <strong>Pengisian:&nbsp;<?= Html::encode($led->progress) ?> %</strong>
                    <div class="kt-space-10"></div>
                    <?=
                    Progress::widget([
                        'percent' => $led->progress,
                        'barOptions' => ['class' => 'progress-bar-info m-progress-lg'],
                        'options' => ['class' => 'progress-sm']
                    ]); ?>
                </div>

            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <div class="kt-section kt-section--first" style="margin-bottom: 0;">

            <div class="row">
                <div class="col-lg-12">
                    <?= $this->render('_tabel_led_eksternal',
                        compact('json_eksternal', 'modelEksternal', 'untuk', 'prodi', 'led')) ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->render('_tabel_led_profil',
                        compact('json_profil', 'modelProfil', 'untuk', 'prodi', 'led')) ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->render('_tabel_led_kriteria', compact('json', 'kriteria', 'prodi', 'untuk', 'led')) ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->render('_tabel_led_analisis',
                        compact('json_analisis', 'modelAnalisis', 'untuk', 'prodi', 'led')) ?>

                </div>
            </div>
        </div>
    </div>
</div>
