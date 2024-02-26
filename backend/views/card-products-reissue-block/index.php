<?php

use common\models\CardProductsReissueBlock;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CardProductsReissueBlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Card Products Reissue Blocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-products-reissue-block-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Card Products Reissue Block', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'branch_id',
            'card_product_id',
            'blocked_from',
            'blocked_to',
            //'branches_ec_id',
            //'key',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CardProductsReissueBlock $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
