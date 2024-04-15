<?php

use common\models\ServiceResponseLocalizations;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SearchServiceResponseLocalizations */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Response Localizations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-response-localizations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Service Response Localizations', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'CODE',
            'DESCRIPTION',
            'TYPE',
            'KEY',
            //'CREATED_AT',
            //'UPDATED_AT',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ServiceResponseLocalizations $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID' => $model->ID]);
                 }
            ],
        ],
    ]); ?>


</div>
