<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SurveyOptions */

$this->title = 'Update Survey Options: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Survey Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="survey-options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
