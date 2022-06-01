<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\State $model
*/

$this->title = Yii::t('models', 'State');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'State'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->state_code, 'url' => ['view', 'state_code' => $model->state_code]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="giiant-crud liststate-update">

    <h1>
                <?= Html::encode($model->state_code) ?>

        <small>
            <?= Yii::t('models', 'State') ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . 'View', ['view', 'state_code' => $model->state_code], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
