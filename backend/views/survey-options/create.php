<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SurveyOptions */

$this->title = 'Create Survey Options';
$this->params['breadcrumbs'][] = ['label' => 'Survey Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
