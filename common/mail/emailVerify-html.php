<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */


$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Hello: <h3><?= Html::encode($user->username) ?> </h3></p>
    <p>Your Code: <h3><?= Html::encode(Yii::$app->cache->get($user->email)) ?> </h3></p>
    <p>Please Confirm Your code: <h3><?= Html::encode($user->username) ?> </h3></p>
</div>
