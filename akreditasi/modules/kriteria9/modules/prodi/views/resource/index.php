<?php

/**
 * @var $this yii\web\View
 * @var $profilFakultas common\models\Profil
 * @var $profilInstitusi common\models\Profil
 * @var $profilUnit common\models\Profil[]
 * @var $kegiatanUnit common\models\unit\KegiatanUnit[]
 * @var $berkasFakultas common\models\Berkas[]
 * @var $berkasInstitusi common\models\Berkas[]
 * @var $kode string
 * @var $jenis string
 * @var $id_led_lk int
 * @var $kriteria int
 * @var $model \common\models\ProgramStudi
 * @var $jenis_dokumen string
 */


use yii\bootstrap4\Html;

$this->title = 'Shared Resource'


?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Resource
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">


        <ul class="nav nav-tabs nav-fill nav-tabs-line nav-tabs-line-brand" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#kt_tabs_9_1" role="tab"><i class="flaticon-time-2"></i> Institusi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_tabs_9_2" role="tab"><i class="flaticon2-edit"></i> Fakultas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_tabs_9_3" role="tab"><i class="flaticon-multimedia"></i> Unit</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="kt_tabs_9_1" role="tabpanel">
              <?= $this->render('_institusi', ['profilInstitusi'=>$profilInstitusi,'berkasInstitusi'=>$berkasInstitusi,'prodi'=>$model,'kode'=>$kode,'jenis'=>$jenis,'id_led_lk'=>$id_led_lk,'kriteria'=>$kriteria,'jenis_dokumen'=>$jenis_dokumen]) ?>
            </div>
            <div class="tab-pane" id="kt_tabs_9_2" role="tabpanel">
               <?=$this->render('_fakultas', ['berkasFakultas'=>$berkasFakultas,'profilFakultas'=>$profilFakultas,'prodi'=>$model,'kode'=>$kode,'jenis'=>$jenis,'id_led_lk'=>$id_led_lk,'kriteria'=>$kriteria,'jenis_dokumen'=>$jenis_dokumen])?>
            </div>
            <div class="tab-pane" id="kt_tabs_9_3" role="tabpanel">
               <?=$this->render('_unit', ['kegiatanUnit'=>$kegiatanUnit,'profilUnit'=>$profilUnit,'prodi'=>$model,'kode'=>$kode,'jenis'=>$jenis,'id_led_lk'=>$id_led_lk,'kriteria'=>$kriteria,'jenis_dokumen'=>$jenis_dokumen])?>
            </div>
        </div>
    </div>
</div>
