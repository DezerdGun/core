<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EposSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

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
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
