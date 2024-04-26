<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SurveyQuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Survey Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-questions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Survey Questions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'survey_id',
            'text_ru',
            'text_uz',
            'text_en',
            //'subtext_ru',
            //'subtext_uz',
            //'subtext_en',
            //'type',
            //'sort_order',
            //'create_at',
            //'update_at',
            //'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SurveyQuestions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
