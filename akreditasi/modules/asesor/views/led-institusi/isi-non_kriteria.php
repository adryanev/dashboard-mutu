<?php
/**
 * @var $this yii\web\View
 * @var $ledInstitusi common\models\kriteria9\led\institusi\K9LedInstitusi
 * @var $json common\models\kriteria9\led\Led
 * @var $detail common\models\kriteria9\led\institusi\K9LedInstitusiNonKriteriaDokumen
 */

$this->title = "Narasi " . $json->nama;
$this->params['breadcrumbs'][] = ['label' => 'Beranda', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = ['label' => 'Asesor', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = [
    'label' => \yii\helpers\StringHelper::mb_ucfirst($untuk) . ' Led',
    'url' => ['led-institusi/' . $untuk, 'led' => $ledInstitusi->id]
];
$this->params['breadcrumbs'][] = $this->title;


use yii\bootstrap4\Html;
use yii\bootstrap4\Progress;

?>

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    <?= Html::encode($this->title) ?>

                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <strong>Kelengkapan Berkas &nbsp; : <?= $modelNarasi->progress ?> %</strong>
                    <div class="kt-space-10"></div>
                    <?=
                    Progress::widget([
                        'percent' => $modelNarasi->progress,
                        'barOptions' => ['class' => 'progress-bar-info m-progress-lg'],
                        'options' => ['class' => 'progress-sm']
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first" style="margin-bottom: 0;">
                <!--begin::Accordion-->
                <div class="accordion accordion-solid  accordion-toggle-plus" id="accordion">


                    <?php
                    if ($currentPoint):
                        foreach ($poin as $key => $item):
                            $modelAttribute = \common\helpers\NomorKriteriaHelper::changeToDbFormat($item->nomor);

                            ?>
                            <div class="card">
                                <div class="card-header" id="heading-<?= $key ?>">
                                    <div class="card-title collapsed" data-toggle="collapse"
                                         data-target="#collapse-<?= $key ?>"
                                         aria-expanded="false" aria-controls="collapse-<?= $key ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <i class="flaticon-file-2"></i> <?=
                                                $item->nomor ?>&nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <small>&nbsp;<?= $item->nama ?></small>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapse-<?= $key ?>" class="collapse" aria-labelledby="heading-<?= $key ?>">
                                    <div class="card-body">
                                        <div class="kt-spinner kt-spinner--center kt-spinner--primary kt-spinner--v2"
                                             id="spinner-<?= $key ?>" data-poin="<?= $json->nomor ?>"
                                             data-nomor="<?= $item->nomor ?>"></div>
                                        <div id="result-<?= $key ?>"></div>
                                    </div>

                                </div>
                            </div>

                        <?php endforeach;
                    else:
                        ?>
                        <div class="card">
                            <div class="card-header" id="heading-1">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse-1"
                                     aria-expanded="false" aria-controls="collapse-1">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <i class="flaticon-file-2"></i> <?=
                                            $json->nomor ?>&nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <small>&nbsp;<?= $json->nama ?></small>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapse-1" class="collapse" aria-labelledby="heading-1">
                                <div class="card-body">
                                    <div class="kt-spinner kt-spinner--center kt-spinner--primary kt-spinner--v2"
                                         id="spinner-1" data-poin="<?= $json->nomor ?>"
                                         data-nomor="<?= $json->nomor ?>"></div>
                                    <div id="result-<?= $json->nomor ?>"></div>
                                </div>

                            </div>
                        </div>

                    <?php endif; ?>
                </div>

                <!--end::Accordion-->

            </div>
        </div>
    </div>
<?php
$url = \yii\helpers\Url::to([
    'led-institusi/butir-item-non-kriteria',
    'led' => $ledInstitusi->id,
    'untuk' => $untuk
], true);
$js = <<<JS
var loaded = {};
$('#accordion').on('shown.bs.collapse',function(t) {
var url = new URL("{$url}");
var target = t.target.children[0].children[0];
var poin = target.dataset.poin
url.searchParams.append('poin',poin)
var nomor = target.dataset.nomor
url.searchParams.append('nomor',nomor)
if(loaded[poin]==null){
$.ajax({
url:url,
method:'GET',
dataType:"html"
}).done(function(html){
    loaded[nomor] = html
    $("#"+target.id).removeAttr('class').next().html(html)


})
}

})
JS;

$this->registerJs($js);



