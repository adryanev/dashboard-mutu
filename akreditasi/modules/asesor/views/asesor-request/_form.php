<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\AsesorRequest
 * @var $dataProdi array
 */

?>
    <div class="form-request">
        <?php $form = \yii\bootstrap4\ActiveForm::begin() ?>

        <div class="form-group">
            <?= \yii\helpers\Html::dropDownList('tipe', null, ['pt' => 'Perguruan Tinggi', 'prodi' => 'Program Studi'],
                ['class' => 'form-control', 'label' => 'Tipe', 'prompt' => 'Pilih Tipe', 'id' => 'tipe']) ?>
        </div>
        <?= $form->field($model, 'id_prodi',
            [
                'options' => [
                    'id' => 'dropdown-prodi',
                    'class' => 'form-group d-none'
                ]
            ])->widget(\kartik\select2\Select2::className(), [
            'data' => $dataProdi,
            'options' => [
                'prompt' => 'Pilih Program Studi'
            ]
        ])->label('Program Studi') ?>

        <div class="form-group">
            <?= \yii\bootstrap4\Html::submitButton('Simpan',
                ['class' => 'btn btn-primary btn-pill btn-elevate btn-elevate-air']) ?>
        </div>
        <?php \yii\bootstrap4\ActiveForm::end() ?>
    </div>
<?php
$js = <<<JS

    $('#tipe').change(function (){
        var value = this.value
        if(value === 'pt'){
            $('#dropdown-prodi').addClass('d-none')
            $('#asesorrequest_id_prodi').val(null)
        }
        else if(value === 'prodi') {
            $('#dropdown-prodi').removeClass('d-none')
        }

        else {
              $('#dropdown-prodi').addClass('d-none')
                $('#asesorrequest_id_prodi').val(null)
        }
    })
JS;

$this->registerJs($js);

