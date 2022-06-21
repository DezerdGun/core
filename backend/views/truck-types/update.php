<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\TruckTypes $model
*/

$this->title = Yii::t('models', 'Truck Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Truck Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'code' => $model->code]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="giiant-crud truck-types-update">

    <h1>
                <?= Html::encode($model->name) ?>

        <small>
            <?= Yii::t('models', 'Truck Types') ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . 'View', ['view', 'code' => $model->code], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
