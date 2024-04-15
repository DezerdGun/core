<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CardDelivery */

$this->title = 'Update Card Delivery: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Card Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card-delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
