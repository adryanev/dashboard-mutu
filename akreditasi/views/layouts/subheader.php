<?php

use common\widgets\Breadcrumbs;

?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            <?=$this->title?> </h3>
        <span class="kt-subheader__separator kt-hidden"></span>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

    </div>
</div>

<!-- end:: Subheader -->