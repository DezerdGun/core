<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CardProductsReissueBlock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-products-reissue-block-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'branch_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blocked_from')->textInput() ?>

    <?= $form->field($model, 'blocked_to')->textInput() ?>

    <?= $form->field($model, 'branches_ec_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
