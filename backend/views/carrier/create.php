<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Carrier $model
*/

$this->title = Yii::t('models', 'Carrier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Carriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud carrier-create">

    <h1>
                <?= Html::encode($model->id) ?>
        <small>
            <?= Yii::t('models', 'Carrier') ?>
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
