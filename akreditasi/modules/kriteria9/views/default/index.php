<?php

use yii\bootstrap4\Html;

$this->title = 'Akreditasi 9 Kriteria';
?>


<!--portlet institusi-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon">
													<i class="flaticon2-graph"></i>
												</span>
            <h3 class="kt-portlet__head-title">
                Institusi
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        Universitas Islam Negeri Sultan Syarif Kasim Riau.
    </div>
    <div class="kt-portlet__foot">
        <div class="row align-items-center">
            <div class="col-lg-6 m--valign-middle">

            </div>
            <div class="col-lg-6 kt-align-right">
                <?= Html::a("<i class='la la-file-o'></i>Institusi", ['/kriteria9/k9-institusi/default/index'],
                    ['class' => 'btn btn-primary btn-wide']) ?>
            </div>
        </div>
    </div>
</div>
<!--end institusi-->

<!--fakultas-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon">
													<i class="flaticon2-graph"></i>
												</span>
            <h3 class="kt-portlet__head-title">
                Fakultas
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        Fakultas di Universitas Islam Negeri Sultan Syarif Kasim Riau.
    </div>
    <div class="kt-portlet__foot">
        <div class="row align-items-center">
            <div class="col-lg-6 m--valign-middle">

            </div>
            <div class="col-lg-6 kt-align-right">
                <?= Html::a("<i class='la la-file-o'></i>Fakultas", ['/kriteria9/fakultas/arsip'],
                    ['class' => 'btn btn-primary btn-wide']) ?>
            </div>
        </div>
    </div>
</div>
<!--end fakultas-->

<!--prodi-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon">
													<i class="flaticon2-graph"></i>
												</span>
            <h3 class="kt-portlet__head-title">
                Program Studi
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        Program Studi di Universitas Islam Negeri Sultan Syarif Kasim Riau.
    </div>
    <div class="kt-portlet__foot">
        <div class="row align-items-center">
            <div class="col-lg-6 m--valign-middle">

            </div>
            <div class="col-lg-6 kt-align-right">
                <?= Html::a("<i class='la la-file-o'></i>Prodi", ['/kriteria9/prodi/arsip'],
                    ['class' => 'btn btn-primary btn-wide']) ?>
            </div>
        </div>
    </div>
</div>
<!--end prodi-->
