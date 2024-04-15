<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CardDelivery */

$this->title = 'Create Card Delivery';
$this->params['breadcrumbs'][] = ['label' => 'Card Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-delivery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
