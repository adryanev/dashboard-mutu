<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\bootstrap4\Html;

$this->context->layout = 'main-error';
$this->title = $name;
$posTag = strpos($name, '#');
$substring = substr($name, $posTag + 1, '3');
?>
<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v6"
         style="background-image: url(<?= Yii::getAlias('@web/media/bg/bg6.jpg') ?>);">
        <div class="kt-error_container">
            <div class="kt-error_subtitle kt-font-light">
                <h1>Oops...</h1>

            </div>
            <p class="kt-error_description kt-font-light">
                <?= $name ?><br>
                <?= $message ?><br>


            </p>
            <?= !Yii::$app->user->isGuest ? Html::a('Logout', ['site/logout'], [
                'class' => 'btn btn-default btn-pill btn-elevate btn-elevate-air',
                'data' => ['method' => 'post', 'confirm' => 'Apakah anda ingin keluar?']
            ]) : "" ?>
        </div>
    </div>
</div>

<!-- end:: Page -->
