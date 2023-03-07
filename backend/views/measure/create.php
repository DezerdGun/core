<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\Measure $model
*/

$this->title = Yii::t('models', 'Measure');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Measures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud measure-create">

    <h1>
                <?= Html::encode($model->name) ?>
        <small>
            <?= Yii::t('models', 'Measure') ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=             Html::a(
            'Cancel',
            \yii\helpers\Url::previous(),
            ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
