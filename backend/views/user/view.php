<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models.plural', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud user-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Html::encode($model->name) ?>
        <small>
            <?= Yii::t('models', 'User') ?>
        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?php
            echo Html::a(
                '<span class="glyphicon glyphicon-pencil"></span> ' . 'Edit',
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-info'])
            ?>

            <?php
            echo Html::a(
                '<span class="glyphicon glyphicon-copy"></span> ' . 'Copy',
                ['create', 'id' => $model->id, 'User' => $copyParams],
                ['class' => 'btn btn-success'])
            ?>

            <?php
            echo Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . 'New',
                ['create'],
                ['class' => 'btn btn-success'])
            ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . 'Full list', ['index'], ['class' => 'btn btn-default']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('common\models\User'); ?>


    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'status',
            'username',
            'email:email',
            'password_hash',
        ],
    ]);
    ?>


    <hr/>

    <?php
    echo Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 'Delete', ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data-confirm' => '' . 'Are you sure to delete this item?' . '',
            'data-method' => 'post',
        ]);
    ?>
    <?php $this->endBlock(); ?>



    <?php
    echo Tabs::widget(
        [
            'id' => 'relation-tabs',
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => '<b class=""># ' . Html::encode($model->id) . '</b>',
                    'content' => $this->blocks['common\models\User'],
                    'active' => true,
                ],
            ]
        ]
    );
    ?>
</div>
