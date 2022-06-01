<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\State $model
*/

$this->title = Yii::t('models', 'State');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'States'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud liststate-create">

    <h1>
                <?= Html::encode($model->state_code) ?>
        <small>
            <?= Yii::t('models', 'State') ?>
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
