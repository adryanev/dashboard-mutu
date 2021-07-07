<?php

/* @var $modelProdi ProgramStudi */
/* @var $profil common\models\Profil */

use common\models\ProgramStudi;
use yii\bootstrap4\Html;

$this->title = $modelProdi->nama;


?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Profil Program Studi
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">

                    <?= Html::a('<i class=flaticon2-edit></i> Edit', ['profil/index', 'prodi' => Yii::$app->request->get('prodi')], ['class' => 'btn btn-info btn-elevate btn-elevate-air']); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">



        <div class="kt-section kt-section--first" style="margin-bottom: 0;">

            <div class="row">
                <div class="col-lg-12">
                    <h3>Profil</h3>
                    <div class="profil">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Visi</h5>
                                        <p class="card-text">
                                            <?=$profil->visi?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Misi</h5>
                                        <p class="card-text">
                                            <?=$profil->misi?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tujuan</h5>
                                        <p class="card-text">
                                            <?=$profil->tujuan?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Sasaran</h5>
                                        <p class="card-text">
                                            <?=$profil->sasaran?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Motto</h5>
                                        <p class="card-text">
                                            <?=$profil->motto?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Sambutan</h5>
                                        <p class="card-text">
                                            <?=$profil->sambutan?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Struktur Organisasi</h5>
                                        <?php if($profil->struktur_organisasi):?>
                                        <?=Html::img(Yii::getAlias("@.uploadStruktur/{$profil->type}/{$modelProdi->id}/{$profil->struktur_organisasi}"),['width'=>'80%'])?>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <h3>Data Prodi</h3>
                    <div class="data-prodi">
                        <table class="table table-striped">

                            <tbody>
                            <tr>
                                <th scope="row">Kode</th>
                                <td><?= Html::encode($modelProdi->kode) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">KAPRODI</th>
                                <td><?= Html::encode($modelProdi->kaprodi) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jenjang</th>
                                <td><?= Html::encode($modelProdi->jenjang) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Fakultas</th>
                                <td><?= Html::encode($modelProdi->fakultasAkademi->nama) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nomor SK Pendirian</th>
                                <td><?= Html::encode($modelProdi->nomor_sk_pendirian) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal SK Pendirian</th>
                                <td><?= Html::encode($modelProdi->tanggal_sk_pendirian) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Bulan berdiri</th>
                                <td><?= Html::encode($modelProdi->bulan_berdiri) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tahun berdiri</th>
                                <td><?= Html::encode($modelProdi->tahun_berdiri) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nomor SK Operasional</th>
                                <td><?= Html::encode($modelProdi->nomor_sk_operasional) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal SK Operasional</th>
                                <td><?= Html::encode($modelProdi->tanggal_sk_operasional) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Peringkat BAN-PT Terakhir</th>
                                <td><?= Html::encode($modelProdi->peringkat_banpt_terakhir) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nilai BAN-PT Terakhir</th>
                                <td><?= Html::encode($modelProdi->nilai_banpt_terakhir) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nomor SK BAN-PT</th>
                                <td><?= Html::encode($modelProdi->nomor_sk_banpt) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Alamat</th>
                                <td><?= Html::encode($modelProdi->alamat) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Pos</th>
                                <td><?= Html::encode($modelProdi->kodepos) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nomor Telpon</th>
                                <td><?= Html::encode($modelProdi->nomor_telp) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Homepage</th>
                                <td><?= Html::encode($modelProdi->homepage) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?= Html::encode($modelProdi->email) ?></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        </div>
    </div>
</div>
