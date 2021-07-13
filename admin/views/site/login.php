<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model akreditasi\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout='main-login';
?>
<div class="kt-login__signin">
    <div class="kt-login__head">
        <h3 class="kt-login__title"><?=Html::encode(Yii::$app->name)?></h3>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class'=>'kt-form']
    ]); ?>
    <form class="kt-form" action="">
        <?= $form->field($model, 'username')->textInput(['placeholder'=>'Username'])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false) ?>


            <?= $form->field($model, 'rememberMe',['template'=>"<div class=\"row kt-login__extra\"><div class=\"col\"><label class='kt-checkbox'>{input} Ingat saya<span></span></span></label> </div>\n<div class=\"col-lg-8\">{error}</div></div>"])->textInput([
                'class'=>"",'type'=>'checkbox']) ?>

        <div class="kt-login__actions">
            <?= Html::submitButton('Login', ['class' => 'btn btn-brand btn-pill kt-login__btn-primary', 'id'=>'kt_login_signin_submit','name' => 'login-button']) ?>
        </div>
    </form>
    <?php ActiveForm::end() ?>
</div>


