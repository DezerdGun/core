<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceResponseLocalizations */

$this->title = 'Update Service Response Localizations: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Service Response Localizations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-response-localizations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
