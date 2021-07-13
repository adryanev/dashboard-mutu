<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Berkas
 * @var $prodi common\models\ProgramStudi
 * @var $kode string
 * @var $jenis string
 * @var $jenis_dokumen string
 * @var $id_led_lk int
 * @var $kriteria int
 */

use yii\bootstrap4\Html;
use yii\helpers\Url;

?>
    <div class="row">
        <div class="col-lg-12">
            <h4><?= $key . '. ' . $model->nama_berkas ?></h4>
            <?= \kartik\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getDetailBerkas()]),
                'summary' => false,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn', 'header' => 'No'],
                    'isi_berkas',
                    [
                        'class' => 'common\widgets\ActionColumn',
                        'header' => 'Aksi',
                        'template' => '{lihat}{gunakan}',
                        'buttons' => [

                            'lihat' => function ($url, $model, $key) {
                                return Html::button('<i class="flaticon2-magnifier-tool"></i> Lihat', [
                                    'value' => Url::to(['resource/lihat-berkas-detail', 'id' => $model->id]),
                                    'title' => $model->isi_berkas,
                                    'class' => 'btn btn-warning btn-sm btn-pill btn-elevate btn-elevate-air showModalBerkasButton'
                                ]);
                            },
                            'gunakan' => function ($url, $model, $key) use (
                                $prodi,
                                $kode,
                                $jenis,
                                $id_led_lk,
                                $kriteria,
                                $jenis_dokumen
                            ) {
                                return Html::a('<i class="flaticon2-laptop"></i> Gunakan', ['resource/gunakan'], [
                                    'class' => 'btn btn-primary btn-pill btn-elevate btn-elevate-air',
                                    'data' => [
                                        'confirm' => "Apakah anda ingin menggunakan data: {$model->isi_berkas} untuk pengisisan $jenis kode $kode?",
                                        'method' => 'POST',
                                        'params' => [
                                            'id' => $model->id,
                                            'prodi' => $prodi->id,
                                            'kode' => $kode,
                                            'jenis' => $jenis,
                                            'id_led_lk' => $id_led_lk,
                                            'kriteria' => $kriteria,
                                            'jenis_dokumen' => $jenis_dokumen
                                        ]
                                    ]
                                ]);
                            }
                        ]
                    ]
                ]
            ]) ?>
        </div>
    </div>

<?php yii\bootstrap4\Modal::begin([
    'title' => '<span id="modalBerkasHeaderTitle"></span>',
    'headerOptions' => ['id' => 'modalBerkasHeader'],
    'id' => 'modalBerkas',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static'],
    'closeButton' => false


]);
echo "<div id='modalBerkasContent'></div>";
yii\bootstrap4\Modal::end();

$js = <<<JS
$(function(){

    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
//we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
    $(document).on('click', '.showModalBerkasButton', function () {
        //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content.
        if ($('#modalBerkas').data('bs.modal').isShown) {
            $('#modalBerkas').find('#modalBerkasContent')
                .load($(this).attr('value'));
            //dynamiclly set the header for the modal
            document.getElementById('modalBerkasHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            $('#modalBerkas').modal('show')
                .find('#modalBerkasContent')
                .load($(this).attr('value'));
            //dynamiclly set the header for the modal
            document.getElementById('modalBerkasHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
});

JS;
$this->registerJs($js);
