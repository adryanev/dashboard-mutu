<?php

use yii\helpers\Html;

$namaLengkap = Html::encode(Yii::$app->user->identity->profilUser->nama_lengkap);
$inisial = mb_strtoupper(mb_substr(Html::encode(Yii::$app->user->identity->profilUser->nama_lengkap), 0, 1));
$roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
$role = ucfirst(array_keys($roles)[0]);
?>
<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <!-- begin:: Header Menu -->
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">


        <!-- begin:: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu--layout-default ">
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here  kt-menu__item--active"><a
                            href="javascript:;" class="kt-menu__link kt-menu__toggle" id="time"><span
                                class="kt-menu__link-text"></span></a>

                    </li>

                </ul>
            </div>
        </div>
    </div>


    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Assalamu'alaikum,</span>
                    <span
                        class="kt-header__topbar-username kt-hidden-mobile"><?= mb_strtoupper($namaLengkap) ?></span>
                    <!--                    <img class="kt-hidden" alt="Pic" src="./assets/media/users/300_25.jpg" />-->

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span
                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><?= Html::encode($inisial) ?></span>
                </div>
            </div>
            <div
                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                     style="background-image: url(<?php echo Yii::getAlias('@web/media/bg/bg-1.jpg') ?>)">
                    <div class="kt-user-card__avatar">
                        <!--                        <img class="kt-hidden" alt="Pic" src="./assets/media/users/300_25.jpg" />-->

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span
                            class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"><?= $inisial ?></span>
                    </div>
                    <div class="kt-user-card__name">
                        <?= $namaLengkap ?>
                    </div>
                    <div class="kt-user-card__badge">
                        <span class="btn btn-success btn-sm btn-bold btn-font-md"><?= $role ?></span>
                    </div>
                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <?= Html::a("<div class=\"kt-notification__item-icon\">
                            <i class=\"flaticon2-calendar-3 kt-font-success\"></i>
                        </div>
                        <div class=\"kt-notification__item-details\">
                            <div class=\"kt-notification__item-title kt-font-bold\">
                                Profil Saya
                            </div>
                            <div class=\"kt-notification__item-time\">
                                Pengaturan akun dan lainnya
                            </div>
                        </div>", ['/profile'], ['class' => 'kt-notification__item']) ?>

                    <div class="kt-notification__custom kt-space-between">
                        <?= \yii\bootstrap4\Html::a('Keluar', ['/site/logout'], [
                            'class' => 'btn btn-label btn-label-brand btn-sm btn-bold',
                            'data' => ['method' => 'post', 'confirm' => 'Apakah anda ingin keluar?']
                        ]) ?>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>

<!-- end:: Header -->

<?php
$jsTime = <<<JS
var timeDisplay = document.getElementById("time");


function refreshTime() {
    moment.locale('ID');
  var dateString = moment().format('dddd, D MMMM YYYY, HH:mm:ss');
  timeDisplay.innerHTML = dateString;
}

setInterval(refreshTime, 1000);
JS;
$this->registerJs($jsTime, \yii\web\View::POS_LOAD);

?>
