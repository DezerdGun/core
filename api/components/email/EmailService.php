<?php

namespace api\components\email;

use common\models\User;
use yii;

class EmailService
{

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    public function sendEmail(User $user)
    {
        $user->confirm_code = mt_rand(1000,9999);
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
}
