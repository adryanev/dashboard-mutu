<?php
/**
 * @var $this yii\web\View
 * @var $kegiatanUnit common\models\unit\KegiatanUnit[]
 * @var $profilUnit common\models\Unit[]
 * @var $prodi common\models\ProgramStudi
 * @var $kode string
 * @var $jenis string
 * @var $jenis_dokumen string
 * @var $id_led_lk int
 * @var $kriteria int
 */

?>

<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-pills nav-fill" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#unit_profil">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#unit_berkas">Berkas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#unit_kegiatan">Kegiatan</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="unit_profil" role="tabpanel">
                <h3>Profil Unit</h3>
                <div class="kt-separator"></div>
                <?php foreach ($profilUnit as $unit): ?>
                    <h5><?=$unit->nama?></h5>
                    <?= $this->render('_profil', ['profil'=>$unit->profil])?>
                    <div class="kt-separator kt-separator--dashed"></div>
                <?php endforeach; ?>
            </div>
            <div class="tab-pane" id="unit_berkas" role="tabpanel">
                <h3>Berkas Unit</h3>
                <div class="kt-separator"></div>
                <?php foreach ($profilUnit as $unit): ?>
                    <h5><?=$unit->nama?></h5>
                    <?= $this->render('_berkas', ['berkas'=>new \yii\data\ActiveDataProvider(['query' => $unit->getBerkas()]),'prodi'=>$prodi,'kode'=>$kode
                        ,'jenis'=>$jenis,'id_led_lk'=>$id_led_lk, 'kriteria'=>$kriteria,'jenis_dokumen'=>$jenis_dokumen])?>
                    <div class="kt-separator kt-separator--dashed"></div>
                <?php endforeach; ?>
            </div>
            <div class="tab-pane" id="unit_kegiatan" role="tabpanel">
                <h3>Kegiatan Unit</h3>
                <div class="kt-separator"></div>
                <?php foreach ($profilUnit as $unit): ?>
                    <h5><?=$unit->nama?></h5>
                    <?= $this->render('_kegiatan_unit', ['kegiatan'=>new \yii\data\ActiveDataProvider(['query' => $unit->getKegiatans()]),'prodi'=>$prodi,'kode'=>$kode
                    ,'jenis'=>$jenis,'id_led_lk'=>$id_led_lk, 'kriteria'=>$kriteria,'jenis_dokumen'=>$jenis_dokumen])?>
                    <div class="kt-separator kt-separator--dashed"></div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>
