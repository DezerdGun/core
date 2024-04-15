<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CardProductsReissueBlock */

$this->title = 'Create Card Products Reissue Block';
$this->params['breadcrumbs'][] = ['label' => 'Card Products Reissue Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-products-reissue-block-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
