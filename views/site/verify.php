<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Verify Email';

?>

<div class="user-verify-email">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please enter the verification code sent to your email.</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <!-- Display flash messages -->
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

</div>
