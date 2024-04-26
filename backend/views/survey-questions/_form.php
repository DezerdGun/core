<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SurveyQuestions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="survey-questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'survey_id')->textInput() ?>

    <?= $form->field($model, 'text_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtext_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtext_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtext_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
