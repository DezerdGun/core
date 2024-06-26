<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\Truck $model
*/

$this->title = Yii::t('models', 'Truck');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Truck'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="giiant-crud truck-update">

    <h1>
                <?= Html::encode($model->name) ?>

        <small>
            <?= Yii::t('models', 'Truck') ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . 'View', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
