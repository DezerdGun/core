<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TietoTransactionTypes */

$this->title = 'Create Tietotransactiontypes';
$this->params['breadcrumbs'][] = ['label' => 'Tietotransactiontypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tietotransactiontypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
