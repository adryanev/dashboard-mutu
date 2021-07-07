<?php

use common\helpers\FileIconHelper;
use common\helpers\FileTypeHelper;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\unit\KegiatanUnit */
/* @var $detailData [] */
/* @var $path */
$unit = $_GET['unit'];
$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Unit', 'url' => ['index', 'unit' => $unit]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-list-3"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">


                            <?= Html::a('<i class=flaticon2-edit></i> Edit',
                                ['update', 'id' => $model->id, 'unit' => $unit],
                                ['class' => 'btn btn-warning btn-elevate btn-elevate-air']) ?>
                            <?= Html::a('<i class=flaticon2-delete></i> Hapus',
                                ['delete', 'id' => $model->id, 'unit' => $unit], [
                                    'class' => 'btn btn-danger btn-elevate btn-elevate-air',
                                    'data' => [
                                        'confirm' => 'Apakah anda ingin menghapus item ini?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kegiatan-unit-view">


                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'id_unit',
                            'nama',
                            'deskripsi:html',
                            'waktu_mulai:datetime',
                            'waktu_selesai:datetime',
//            'created_at:datetime',
//            'updated_at:datetime',
                        ],
                    ]) ?>

                </div>
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped table-light">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Nama berkas</th>
                                <th class="text-center">Jenis Berkas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($detailData as $datum) : ?>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12 text-center">

                                                <?= FileIconHelper::getIconByExtension($datum->bentuk_file) ?>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <?= \yii\bootstrap4\Html::encode($datum->isi_file) ?>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?= $datum->nama_file ?>
                                    </td>
                                    <td>
                                        <div class="row pull-right">
                                            <div class="col-lg-12 ">
                                                <?php $type = FileTypeHelper::getType($datum->bentuk_file); ?>
                                                <?php Modal::begin([
                                                    'title' => $model->nama,
                                                    'toggleButton' => [
                                                        'label' => '<i class="la la-eye"></i> &nbsp;Lihat',
                                                        'class' => 'btn btn-info btn-pill btn-elevate btn-elevate-air'
                                                    ],
                                                    'size' => 'modal-lg',
                                                    'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                                                ]); ?>
                                                <?php switch ($type) {
                                                    case FileTypeHelper::TYPE_IMAGE:
                                                        echo Html::img("$path/{$datum->isi_file}",
                                                            ['height' => '100%', 'width' => '100%']);
                                                        break;
                                                    case FileTypeHelper::TYPE_STATIC_TEXT:
                                                        echo $datum->isi_file;
                                                        break;
                                                    default:
                                                        echo '<small>Jika dokumen berkas tidak bisa dimuat, klik ' . Html::a('di sini',
                                                                \yii\helpers\Url::to("$path/$datum->isi_file",
                                                                    true), ['target' => '_blank']) . '.</small>';
                                                        echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://docs.google.com/gview?url=' . $path . '/' . rawurldecode($datum->isi_file) . '&embedded=true"></iframe></div>';
                                                        break;
                                                } ?>
                                                <?php Modal::end(); ?>
                                                <?= Html::a('<i class="la la-download"></i>&nbsp;Unduh', [
                                                    'kegiatan/download-detail',
                                                    'dokumen' => $datum->id,
                                                    'unit' => $unit,
                                                    'id' => $_GET['id']
                                                ],
                                                    ['class' => 'btn btn-warning btn-pill btn-elevate btn-elevate-air']) ?>

                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>





