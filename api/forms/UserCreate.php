<?php

namespace api\forms;

use common\models\User;
use yii\base\Model;
use yii;

/**
 * Class UserCreate
 *
 * @OA\Schema(
 *     required={"username","email","password"}
 * )
 */
class UserCreate extends Model
{

    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $username;
    /**
     * @OA\Property(
     *     type="email"
     * )
     */
    public $email ;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $password;
    public $confirm_code;



    public function rules()
    {
        return [
            // the name, email, subject and body attributes are required
            [['username', 'email', 'password'], 'safe'],

            // the email attribute should be a valid email address
            ['email', 'email'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->confirm_code = mt_rand(1000,9999);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        if($this->sendEmail($user) == TRUE)
        {
          return $user->save();
        }else{
          echo 'something gone wrong';
        }
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    public function sendEmail($user)
    {
        return Yii::$app->mailer->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]

            )
            ->setFrom([Yii::$app->params['supportEmail'] => 'TMS 2'])
            ->setTo($this->email)

            ->setSubject('J-team / khalsa-brokerage-tms / core ')
            ->send();
    }




}

