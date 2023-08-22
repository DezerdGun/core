<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\Equipment $model
*/

$this->title = Yii::t('models', 'Equipment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Equipment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'code' => $model->code, 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="giiant-crud equipment-update">

    <h1>
                <?= Html::encode($model->name) ?>

        <small>
            <?= Yii::t('models', 'Equipment') ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . 'View', ['view', 'code' => $model->code, 'name' => $model->name], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
