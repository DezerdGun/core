<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */


$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Hello: <h3><?= Html::encode($user->name) ?> </h3></p>
    <p>Please Confirm Your Email to change your role to SubBroker:</p>
    <h3>
        <a href="http://api.tmp.loc.com">TMS2.jafton.com/<?= Html::encode($user->verification_token) ?></a>
    </h3>
</div>
