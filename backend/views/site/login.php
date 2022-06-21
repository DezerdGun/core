<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

$this->title = 'Login';
?>
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-form">
            <div class="sign-in-htm">
                <div class="group">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true,'class' => 'input']) ?>
                </div>
                <div class="group">
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'input']) ?>
                </div>
                <div class="group">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <div class="group">
                    <?= Html::submitButton('Login', ['class' => 'button']) ?>
                </div>
                <div class="hr"></div>
                <div class="foot-lnk">
                    <h4 style="color: white">Welcome To TMC 2</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
