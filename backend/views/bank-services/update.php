<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BankServices */

$this->title = 'Update Bank Services: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bank Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bank-services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
