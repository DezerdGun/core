<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Epos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'id') ?>

  <?= $form->field($model, 'code') ?>

  <?= $form->field($model, 'specification') ?>

  <?= $form->field($model, 'sort') ?>

  <?= $form->field($model, 'merchant') ?>

  <?php // echo $form->field($model, 'terminal') ?>

  <?php // echo $form->field($model, 'port') ?>

  <?php // echo $form->field($model, 'processing') ?>

  <?php // echo $form->field($model, 'auto_reco') ?>

  <?php // echo $form->field($model, 'created_at') ?>

  <?php // echo $form->field($model, 'updated_at') ?>

  <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
