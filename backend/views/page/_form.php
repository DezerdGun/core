<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use mihaildev\ckeditor\CKEditor;
/**
* @var yii\web\View $this
* @var common\models\Page $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
    'id' => 'page',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-danger',
    'fieldConfig' => [
             'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
             'horizontalCssClasses' => [
                 'label' => 'col-sm-2',
                 #'offset' => 'col-sm-offset-4',
                 'wrapper' => 'col-sm-8',
                 'error' => '',
                 'hint' => '',
             ],
         ],
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            

<!-- attribute page -->
			<?= $form->field($model, 'page')->textInput(['maxlength' => true]) ?>

<!-- attribute block -->
			<?= $form->field($model, 'block')->textInput(['maxlength' => true]) ?>

<!-- attribute text -->
            <?= $form->field($model, 'text')->widget(CKEditor::className(),[
            'editorOptions' => [
            'preset' => 'standard',
            'inline' => false,
            ],
            ]);?>

<!-- attribute id -->
<!--			--><?//= $form->field($model, 'id')->textInput() ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                    'encodeLabels' => false,
                    'items' => [ 
                        [
    'label'   => Yii::t('models', 'page'),
    'content' => $this->blocks['main'],
    'active'  => true,
],
                    ]
                 ]
    );
    ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?= Html::submitButton(
        '<span class="glyphicon glyphicon-check"></span> ' .
        ($model->isNewRecord ? 'Create' : 'Save'),
        [
        'id' => 'save-' . $model->formName(),
        'class' => 'btn btn-success'
        ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>

