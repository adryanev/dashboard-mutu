<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Api
 */

 use yii\bootstrap4\Html;

?>

<div class="row">
    <div class="col-lg-12">
        <div class="api-item">
            <h6><?=Html::encode($model->nama)?></h6>
            <div class="card card-light p-1">
                <div class="card-header">
                    API Key:
                </div>
                <div class="card-body">
                    <p class="card-text">
                       <span id="access-token"><?=Html::encode($model->access_token)?></span>
                       <span>
   <?= \supplyhog\ClipboardJs\ClipboardJsWidget::widget([
                        'inputId' =>'#access-token' ,
                        'label' => '<i class="la la-clipboard"></i>',
                        'htmlOptions' => ['class' => 'btn btn-sm btn-icon btn-outline-brand btn-circle btn-elevate btn-elevate-air'],
                        'tag' => 'button',
]) ?>
 <?=Html::a('<i class="la la-refresh"></i>', ['api/refresh'], ['class'=>'btn btn-icon btn-sm btn-circle btn-outline-danger btn-elevate btn-elevate-air',
    'data'=>[
     'method'=>'POST',
     'confirm'=>'Apakah anda ingin mengganti API Key Ini? Aplikasi bimas tidak akan bisa melihat progress pengisian anda jika tidak memberitahu perubahan ini.',
     'params'=>['id'=>$model->id]
 ]])?>
                       </span>

                    </p>


                </div>
            </div>
        </div>
    </div>
</div>
