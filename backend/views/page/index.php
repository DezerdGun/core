<?php

use common\models\page;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
*/

/**
 * @var common\models\page $model
 * @var common\models\page $provider
 *
 */

$this->title = Yii::t('models', 'Page');
$this->params['breadcrumbs'][] = $this->title;

if (isset($actionColumnTemplates)) {
$actionColumnTemplate = implode(' ', $actionColumnTemplates);
    $actionColumnTemplateString = $actionColumnTemplate;
} else {
Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New', ['create'], ['class' => 'btn btn-success']);
    $actionColumnTemplateString = "{view} {payment}{create}{update} {delete} ";
}
$actionColumnTemplateString = '<div class="action-buttons">'.$actionColumnTemplateString.'</div>';
?>

<div class="giiant-crud page-index">
    <h2 style="margin: 8px;">
<!--        --><?//= Html::a(' <i class="fas fa-file-pdf"></i> '  , ['privacy']) ?>
    </h2>
    <?php \yii\widgets\Pjax::begin(['id' => 'list-data-list', 'timeout' => false, 'enablePushState' => false]) ?>

    <h1>
        <?= Yii::t('models.plural', 'Page') ?>
        <small>
            <?= Yii::t('cruds', 'List') ?>
        </small>
    </h1>
    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <hr />

    <div class="table-responsive">
        <?php echo GridView::widget([
            'layout' => "<div class='tab-bg'>{summary}</div>\n\n<div class='table table-responsive list-table'>{items}\n{pager}</div>",
            'id' => 'myUserGridView',
            'dataProvider' => $provider,
            'filterModel' => $model,
            'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' =>'Page ',
                    'attribute' => 'page',
                    'format' => 'raw',
                ],
                [
                    'label' =>'Block ',
                    'attribute' => 'block',
                    'format' => 'raw',
                ],
                [
                    'label' =>'Text ',
                    'attribute' => 'text',
                    'format' => 'raw',
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'dropdown' => true,
                    'vAlign'=>'middle',
                    'urlCreator' => function($action, $model, $key, $index) {
            return Url::toRoute([$action, 'id' => $model->id]);
            },
                    'viewOptions'=>['title'=>'view', 'data-toggle'=>'tooltip'],
                    'updateOptions'=>['title'=>'update', 'data-toggle'=>'tooltip'],
                    'deleteOptions'=>['title'=>'delete', 'data-toggle'=>'tooltip'],
                ],
                [
                    'header' =>'Operation ',
                    'class' => 'kartik\grid\ActionColumn',
//                    'template' => '{pdf} {update} {view}{delete} ',
                    'template' => '<div class="column-buttons">
                                        <span>{pdf}</span>
                                    </div>',
                    'buttons' => [
                        'pdf'=> function($action, page $model){
                                return html::a('<i class="fas fa-file-pdf"></i>',Url::toRoute(['page/pdfsample','id'=>$model->id,'data-pjax' => 0]),['title'=>'Pdf','data-pjax' => 0]);
                                },
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, page $model) {
                                return Url::toRoute([$action,'page/index', 'id' => $model->id]);
                            }
                        ],

                    ],

                ],
            ],
            'pjax' => true,
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
            'floatHeader' => true,
//                    'floatHeaderOptions' => ['top' => $scrollingTop],
            'showPageSummary' => false,
//            'panel' => [
//                'type' => GridView::TYPE_PRIMARY
//            ],
        ]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>

<script>
    $("#my_tab_id").click(function() {
        $.pjax.reload({container: '#some_pjax_id', async: false});
    });
</script>
