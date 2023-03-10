<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Owner $model
 */

$this->title = Yii::t('models', 'Owner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Owner'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="giiant-crud owner-update">

    <h1>
        <?= Html::encode($model->name) ?>

        <small>
            <?= Yii::t('models', 'Owner') ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . 'View', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr/>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>