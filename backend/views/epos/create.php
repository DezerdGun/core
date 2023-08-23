<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Epos */

$this->title = 'Create Epos';
$this->params['breadcrumbs'][] = ['label' => 'Epos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
