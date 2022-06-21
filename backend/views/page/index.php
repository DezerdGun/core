<?php

use common\models\page;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
*/

/**
 * @var common\models\User $model
 * @var common\models\User $provider
 */

$this->title = Yii::t('models', 'Page');
$this->params['breadcrumbs'][] = $this->title;

if (isset($actionColumnTemplates)) {
$actionColumnTemplate = implode(' ', $actionColumnTemplates);
    $actionColumnTemplateString = $actionColumnTemplate;
} else {
Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New', ['create'], ['class' => 'btn btn-success']);
    $actionColumnTemplateString = "{view} {update} {delete}";
}
$actionColumnTemplateString = '<div class="action-buttons">'.$actionColumnTemplateString.'</div>';
?>
<div class="giiant-crud page-index">

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

        <div class="pull-right">

                        
            <?= 
            \yii\bootstrap\ButtonDropdown::widget(
            [
            'id' => 'giiant-relations',
            'encodeLabel' => false,
            'label' => '<span class="glyphicon glyphicon-paperclip"></span> ' . 'Relations',
            'dropdown' => [
            'options' => [
            'class' => 'dropdown-menu-right'
            ],
            'encodeLabels' => false,
            'items' => [

]
            ],
            'options' => [
            'class' => 'btn-default'
            ]
            ]
            );
            ?>
        </div>
    </div>

    <hr />

    <div class="table-responsive">
        <?php echo GridView::widget([
            'layout' => "<div class='tab-bg'>{summary}</div>\n\n<div class='table table-responsive list-table'>{items}\n{pager}</div>",


            'id' => 'myUserGridView',
            'dataProvider' => $provider,
            'filterModel' => $model,
            'columns' => [

                ['class' => 'yii\grid\CheckboxColumn'],
                ['class' => 'yii\grid\SerialColumn'],
                [
                    //Set field display title
                    'label' => 'ID',
                    'attribute' => 'id',
                    'format' => 'raw',
                    'headerOptions' => [
                        'style' => 'width:120px;',
                    ],
                ],
                [
                    'label' =>'Page ',
                    'attribute' => 'page',
                    'format' => 'raw',
                ],
//          [
//            'label' =>'portrait ',
//            'attribute' => 'head_img',
//            'format' => 'raw',
//            'value' => function ($data) {
//              return '<img src="' . '/' . ltrim($data->head_img, '/') . '" width="60px">';
//            },
//          ],
//          [
//            'label' =>'Block ',
//            'filter' => [0 =>'male ', 1 =>'female'],
//            'attribute' => 'block',
//            'format' => 'raw',
//            'value' => function ($data) {
//              Return ($data -> block == 0)?'male ':'female';
//            }
//          ],
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
                    'header' =>'Operation ',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, page $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ],
            ],
        ]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>

<script>
    $("#my_tab_id").click(function() {
        $.pjax.reload({container: '#some_pjax_id', async: false});
    });
</script>
