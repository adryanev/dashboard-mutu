<?php

use common\helpers\FileIconHelper;
use common\helpers\FileTypeHelper;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Berkas */

$this->title = $model->nama_berkas;
$this->params['breadcrumbs'][] = ['label' => 'Berkas', 'url' => ['index', 'unit' => $_GET['unit']]];
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
                                ['update', 'id' => $model->id, 'unit' => $_GET['unit']],
                                ['class' => 'btn btn-warning btn-elevate btn-elevate-air']) ?>
                            <?= Html::a('<i class=flaticon2-delete></i> Hapus',
                                ['delete', 'id' => $model->id, 'unit' => $_GET['unit']], [
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
                <div class="berkas-view">


                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
//                    'external_id',
//                    'type',
                            'nama_berkas',
                            'created_at:datetime',
                            'updated_at:datetime',
                        ],
                    ]) ?>

                </div>

                <div class="clearfix"></div>

                <div class="detail-berkas-view">
                    <!--                                Tabel dokumen lainnya-->
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;
                        foreach ($model->detailBerkas as $k => $v): ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td>
                                    <div class="text-center">
                                        <?php if ($v->bentuk_berkas !== 'text' && $v->bentuk_berkas !== 'link') { ?>
                                            <div class="icon">
                                                <?= FileIconHelper::getIconByExtension($v->bentuk_berkas) ?>
                                            </div>
                                            <div class="kt-space-5"></div>
                                            <?php

                                            echo $v['isi_berkas'];

                                        } ?>
                                    </div>
                                </td>
                                <td class="pull-right">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php $type = FileTypeHelper::getType($v->bentuk_berkas); ?>

                                            <?php Modal::begin([
                                                'title' => $model->nama_berkas,
                                                'toggleButton' => [
                                                    'label' => '<i class="la la-eye"></i> &nbsp;Lihat',
                                                    'class' => 'btn btn-info btn-sm btn-pill btn-elevate btn-elevate-air'
                                                ],
                                                'size' => 'modal-lg',
                                                'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                                            ]); ?>
                                            <?php switch ($type) {
                                                case FileTypeHelper::TYPE_IMAGE:
                                                    echo Html::img("$url/{$v->isi_berkas}",
                                                        ['height' => '100%', 'width' => '100%']);
                                                    break;
                                                case FileTypeHelper::TYPE_STATIC_TEXT:
                                                    echo $v->isi_berkas;
                                                    break;
                                                default:
                                                    echo '<small>Jika dokumen berkas tidak bisa dimuat, klik ' . Html::a('di sini',
                                                            \yii\helpers\Url::to("$url/$v->isi_berkas",
                                                                true), ['target' => '_blank']) . '.</small>';
                                                    echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://docs.google.com/gview?url=' . $url . '/' . rawurldecode($v->isi_berkas) . '&embedded=true"></iframe></div>';
                                                    break;
                                            } ?>
                                            <?php Modal::end(); ?>
                                            <?php if ($type === FileTypeHelper::TYPE_LINK): ?>
                                                <?= Html::a('<i class="la la-external-link"></i> Lihat', $v->isi_berkas,
                                                    [
                                                        'class' => 'btn btn-info btn-sm btn-pill btn-elevate btn-elevate-air',
                                                        'target' => '_blank'
                                                    ]) ?>
                                            <?php endif; ?>
                                            <?= Html::a('<i class="la la-download"></i>&nbsp;Unduh',
                                                ['berkas/download-berkas', 'id' => $v->id],
                                                ['class' => 'btn btn-warning btn-sm btn-pill btn-elevate btn-elevate-air']) ?>

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
        <!--end::Portlet-->

    </div>
</div>



