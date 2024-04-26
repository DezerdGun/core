<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SurveyOptionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="survey-options-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'question_id') ?>

    <?= $form->field($model, 'text_ru') ?>

    <?= $form->field($model, 'text_uz') ?>

    <?= $form->field($model, 'text_en') ?>

    <?php // echo $form->field($model, 'subtext_ru') ?>

    <?php // echo $form->field($model, 'subtext_uz') ?>

    <?php // echo $form->field($model, 'subtext_en') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
