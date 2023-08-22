<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use frontend\assets\LoginAsset;
LoginAsset::register($this);

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

?>

<a  href="https://front.codes/" class="logo" target="_blank">
    <img  src="../image/121.png" alt="">
<!--    <img  src="../image/22.png" alt="">-->
</a>

<div class="section">
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <div class="section pb-2 pt-5 pt-sm-2 text-center">
                    <h6 class="mb-1 pb-1"><span>Welcome   </span><span>to</span><span>T M C 2</span></h6>
                    <label for="reg-log"></label>
                    <div class="card-3d-wrap mx-auto">
                        <?php $form = ActiveForm::begin([]); ?>
                        <div class="card-3d-wrapper">
                            <div class="card-front">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-4 pb-3">Log In</h4>
                                        <div class="form-group">
                                            <?= $form->field($model, 'email')->textInput([
                                                    'class' => 'form-style',
                                            ]) ?>
                                            <i class="input-icon uil uil-at"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <?= $form->field($model, 'password')->passwordInput([
                                                    'class' => 'form-style'
                                            ]) ?>
                                            <i class="input-icon uil uil-lock-alt"></i>
                                            <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                        </div>
                                        <?= Html::submitButton('Login',['class' => 'btn mt-4', 'name' => 'submit']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


