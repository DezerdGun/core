<?php

namespace api\components\email;

use common\helpers\DateTime;
use common\models\User;
use DateInterval;
use yii;

class EmailService
{

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be sent
     * @return bool whether the email was sent
     */
    public function sendEmail(User $user)
    {
        Yii::$app->cache->set($user->email, mt_rand(1000,9999), 300);
        $user->generateEmailVerificationToken();
        return Yii::$app->mailer->compose(
            ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
            ['user' => $user]
        )
            ->setFrom([Yii::$app->params['supportEmail'] => 'TMS 2'])
            ->setTo($user->email)

            ->setSubject('J-team / khalsa-brokerage-tms / core ')
            ->send();
    }


    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be sent
     * @return bool whether the email was sent
     */
    public function SubEmail(User $user)
    {
        Yii::$app->cache->set( $user->verification_token, mt_rand(1000,9999), 300);
        $user->generateEmailVerificationToken();
        return Yii::$app->mailer->compose(
            ['html' => 'emailBroker-html', 'text' => 'emailVerify-text'],
            ['user' => $user]
        )
            ->setFrom([Yii::$app->params['supportEmail'] => 'TMS 2'])
            ->setTo($user->email)

            ->setSubject('J-team / khalsa-brokerage-tms / core ')
            ->send();
    }
}
