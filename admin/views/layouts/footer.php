<?php

use yii\bootstrap4\Html;

?>
<!-- begin:: Footer -->
<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
    <div class="kt-footer__copyright">
        <?= date('Y') ?>&nbsp;&copy;&nbsp;
        <a href="<?= Yii::$app->params['url_author'] ?>" target="_blank" class="kt-link">
            <?= Html::encode(Yii::$app->params['institusi']) ?> by Adryan Eka Vandra</a>
    </div>
    <div class="kt-footer__menu">
        <a href="<?= Yii::$app->params['url_institusi'] ?>" target="_blank"
           class="kt-footer__menu-link kt-link"><?= Yii::$app->params['institusi'] ?></a>
    </div>
</div>

<!-- end:: Footer -->