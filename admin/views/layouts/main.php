<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\assets\metronic\MetronicDashboardDemo1Asset;
use yii\helpers\Html;
use yii\helpers\Url;

MetronicDashboardDemo1Asset::register($this);
$counterUp = <<<JS
 $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
JS;
$this->registerJs($counterUp, \yii\web\View::POS_READY);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->

    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Url::to(['/favicon.ico'])]); ?>
    <?php $this->head() ?>
</head>
<!-- begin::Body -->
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<?php $this->beginBody() ?>

<?= $this->render('mobile_header') ?>

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <?= $this->render('aside') ?>

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <?= $this->render('header') ?>
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                <?= $this->render('subheader') ?>
                <?= \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]) ?>


                <?= $this->render('content', ['content' => $content]) ?>
            </div>

            <?= $this->render('footer') ?>
        </div>
    </div>
</div>


<!-- end:: Page -->


<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->


<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>


<!-- end::Global Config -->
<?php
yii\bootstrap4\Modal::begin([
    'title' => '<span id="modalHeaderTitle"></span>',
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]


]);
echo "<div id='spinner-modal' class='kt-spinner--v2 kt-spinner--center kt-spinner kt-spinner--primary'></div>";
echo "<div id='modalContent'></div>";
yii\bootstrap4\Modal::end();
?>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
