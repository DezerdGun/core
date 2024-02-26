<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CardProductsReissueBlockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-products-reissue-block-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'branch_id') ?>

    <?= $form->field($model, 'card_product_id') ?>

    <?= $form->field($model, 'blocked_from') ?>

    <?= $form->field($model, 'blocked_to') ?>

    <?php // echo $form->field($model, 'branches_ec_id') ?>

    <?php // echo $form->field($model, 'key') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
