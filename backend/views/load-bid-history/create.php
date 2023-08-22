<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\LoadNote $model
*/

$this->title = Yii::t('models', 'Load Note');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Load Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud load-note-create">

    <h1>
                <?= Html::encode($model->id) ?>
        <small>
            <?= Yii::t('models', 'Load Note') ?>
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
