<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceResponseLocalizations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-response-localizations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KEY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATED_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATED_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
