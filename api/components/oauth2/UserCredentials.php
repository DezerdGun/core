<?php

namespace api\components\oauth2;

use OAuth2\Storage\UserCredentialsInterface;
use common\models\User;

class UserCredentials implements UserCredentialsInterface
{
    /**
     * @inheritDoc
     */
    public function checkUserCredentials($username, $password)
    {
        $user = User::find()->andWhere(['or',['email'=> $username], ['mobile_number' => $username]])->one();
        return $user && $user->validatePassword($password);
    }

    /**
     * @inheritDoc
     */
    public function getUserDetails($username)
    {
        $user = User::find()->andWhere(['or',['email'=> $username], ['mobile_number' => $username]])->one();
        return $user ? ['user_id' => $user->id, 'scope' => $user->scope] : false;
    }
}
