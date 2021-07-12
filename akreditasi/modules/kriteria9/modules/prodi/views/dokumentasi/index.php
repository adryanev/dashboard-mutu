<?php

use common\models\kriteria9\dokumentasi\Dokumentasi;
use yii\bootstrap4\Html;
use yii\helpers\Url;

/**
 * @var $this yii\web\View
 * @var $dokumen Dokumentasi[]
 * @var $dokumenCollection yii2mod\collection\Collection
 */

$this->title = 'Dokumentasi';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <?= Html::encode($this->title)?>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="accordion accordion-light accordion-toggle-arrow" id="accordion-data">
            <?php
            foreach ($dokumen as $key => $doc):
            ?>
                <div class="card">
                    <div class="card-header" id="heading-<?=$key?>">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse-<?=$key?>"
                             aria-controls="collapse-<?=$key?>">
                            <?=$doc->dokumen?>
                        </div>
                       </div>
                    <div class="collapse" id="collapse-<?=$key?>" aria-labelledby="heading-<?=$key?>"
                        >
                        <div class="card-body">
                            <div class="pull-right">
                                <?= Html::button('<i class="la la-upload"></i> Unggah',
                                    ['value'=> Url::to(['dokumentasi/upload','prodi'=>$_GET['prodi'],
                                        'dokumen'=>$doc->dokumen]),'title'=>'Unggah '
                                        .$doc->dokumen,'class'=>'showModalButton btn btn-dark btn-pill btn-elevate
                                        btn-elevate-air'])?>
                                <?= Html::button('<i class="la la-font"></i> Teks',
                                    ['value'=> Url::to(['dokumentasi/teks','prodi'=>$_GET['prodi'],'dokumen'=>$doc->dokumen]),'title'=>'Teks '
                                        .$doc->dokumen,'class'=>'btn btn-success btn-pill btn-elevate
                                        btn-elevate-air showModalButton'])?>
                                <?= Html::button('<i class="la la-link"></i> Tautan',
                                    ['value'=> Url::to(['dokumentasi/link','prodi'=>$_GET['prodi'],'dokumen'=>$doc->dokumen]),'title'=>'Tautan '
                                        .$doc->dokumen,'class'=>'btn btn-info btn-pill btn-elevate btn-elevate-air showModalButton'])?>

                            </div>
                            <div class="clearfix"></div>
                            <div class="kt-separator"></div>

                            <?=\yii\widgets\ListView::widget([
                                'dataProvider' => new \yii\data\ArrayDataProvider
                                (['allModels'=>$dokumenCollection->where('nama_dokumen',$doc->dokumen)->all()]),
                                'itemView' => '_item',
                                'summary' => false
                            ])?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</div>
