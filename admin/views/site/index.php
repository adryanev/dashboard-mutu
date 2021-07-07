<?php

/* @var $this yii\web\View */
/* @var $jumlahProdi integer */
/* @var $jumlahPengguna integer */
/* @var $apt integer */
/* @var $aps integer */
/* @var $persenAps float */
/* @var $persenApt float */

$this->title = 'Beranda';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon">
													<i class="flaticon2-dashboard"></i>
												</span>
                    <h3 class="kt-portlet__head-title">
                        Selamat Datang
                        <small>di Dashboard Admin</small>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <p> Untuk petunjuk penggunaan aplikasi, silahkan merujuk pada buku panduan yang telah diberikan.
                    Fitur bagian admin:</p>
                <ul>
                    <li>Manajemen Data Institusi (Perguran Tinggi, Unit/Satker/Lembaga, Program Studi)</li>
                    <li>Manajemen Data Pengguna (Akun, Hak Akses Pengguna)</li>
                    <li>Manajemen Data Akreditasi Program Studi</li>
                    <li>Manajemen Data Sertifikat Akreditasi</li>
                    <li><i>Monitoring</i> Antrian (Queue Monitor)</li>
                </ul>
            </div>
        </div>

        <!--end::Portlet-->
    </div>
</div>



