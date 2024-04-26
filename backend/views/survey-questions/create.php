<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SurveyQuestions */

$this->title = 'Create Survey Questions';
$this->params['breadcrumbs'][] = ['label' => 'Survey Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-questions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
