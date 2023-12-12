<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BankServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bank Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-services-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bank Services', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'sort',
            'name_ru',
            'name_uz',
            //'name_en',
            //'icon_id',
            //'action',
            //'is_new',
            //'ignore_custom_order',
            //'ignore_disabled',
            //'platform',
            //'created_at',
            //'updated_at',
            //'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BankServices $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
