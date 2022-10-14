<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
*/

$this->title = Yii::t('models', 'Load Note');
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
<div class="giiant-crud load-note-index">

    <?php
//         ?>

    
    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>

    <h1>
        <?= Yii::t('models.plural', 'Load Note') ?>
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
            [
                'url' => ['user/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-left"></i> ' . Yii::t('models', 'User'),
            ],
                                [
                'url' => ['load/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-left"></i> ' . Yii::t('models', 'Load'),
            ],
                    
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
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
        'class' => yii\widgets\LinkPager::className(),
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last',
        ],
                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
        'headerRowOptions' => ['class'=>'x'],
        'columns' => [
                [
            'class' => 'yii\grid\ActionColumn',
            'template' => $actionColumnTemplateString,
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    $options = [
                        'title' => Yii::t('cruds', 'View'),
                        'aria-label' => Yii::t('cruds', 'View'),
                        'data-pjax' => '0',
                    ];
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                }
            ],
            'urlCreator' => function($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                return Url::toRoute($params);
            },
            'contentOptions' => ['nowrap'=>'nowrap']
        ],
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'load_id',
                'value' => function ($model) {
                    if ($rel = $model->load) {
                        return Html::a($rel->id, ['load/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'created_by',
                'value' => function ($model) {
                    if ($rel = $model->createdBy) {
                        return Html::a($rel->username, ['user/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'created_at',
                'value' => function ($model) {
                    if ($rel = $model->createdBy) {
                        return Html::a($rel->created_at = date('Y-m-d H:i:s'), ['user/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat

			'notes:ntext',
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat

                ]
        ]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>


