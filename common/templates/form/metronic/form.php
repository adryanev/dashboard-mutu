<?php
/**
 * This is the template for generating an action view file.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\form\Generator */

echo "<?php\n";

use yii\helpers\Inflector;
use yii\helpers\StringHelper; ?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form ActiveForm */
<?= "?>" ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">file_copy</i>

            </div>
            <div class="card-content">
                <h4 class="card-title">
                    <?= "<?= " ?>Html::encode($this->title) ?>
                </h4>

                <div class="<?= str_replace('/', '-', trim($generator->viewName, '_')) ?>">

                    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

                    <?php foreach ($generator->getModelAttributes() as $attribute): ?>
                        <?= "<?= " ?>$form->field($model, '<?= $attribute ?>') ?>
                    <?php endforeach; ?>

                    <div class="form-group">
                        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Submit') ?>, ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?= "<?php " ?>ActiveForm::end(); ?>

                </div><!-- <?= str_replace('/', '-', trim($generator->viewName, '-')) ?> -->


            </div>
        </div>
    </div>
</div>
