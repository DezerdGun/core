<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\load_modes $model
*/

$this->title = Yii::t('models', 'Load Modes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Load Modes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud load-modes-create">

    <h1>
                <?= Html::encode($model->name) ?>
        <small>
            <?= Yii::t('models', 'Load Modes') ?>
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
