<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BankServices */

$this->title = 'Create Bank Services';
$this->params['breadcrumbs'][] = ['label' => 'Bank Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
