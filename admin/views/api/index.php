<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider use yii\data\ActiveDataProvider;
 */

use yii\widgets\ListView;

$this->title = 'API';
 $this->params['breadcrumbs'][] = $this->title;

?>

<div class="kt-portlet">
<div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title"><?=$this->title?></h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <?=ListView::widget([
            'dataProvider'=>$dataProvider,
            'itemView'=>'_item',
            'summary'=>false
        ])?>
    </div>

</div>
