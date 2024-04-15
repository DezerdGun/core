<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceResponseLocalizations */

$this->title = 'Create Service Response Localizations';
$this->params['breadcrumbs'][] = ['label' => 'Service Response Localizations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-response-localizations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
