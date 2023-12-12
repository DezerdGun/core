<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BankServices */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bank Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bank-services-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'sort',
            'name_ru',
            'name_uz',
            'name_en',
            'icon_id',
            'action',
            'is_new',
            'ignore_custom_order',
            'ignore_disabled',
            'platform',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
