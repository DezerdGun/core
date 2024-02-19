<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LinkProvider */

$this->title = 'Create Link Provider';
$this->params['breadcrumbs'][] = ['label' => 'Link Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-provider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
