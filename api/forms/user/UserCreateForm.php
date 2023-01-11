<?php

namespace api\forms\user;

use api\components\email\EmailService;
use common\models\User;
use yii\base\Model;
use yii;


/**
 * Class UserCreateForm
 *
 * @OA\Schema(
 *     required={"name","email_or_mobile_number", "password"}
 * )
 */
class UserCreateForm extends Model
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $name;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $email;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $password;

    public function rules()
    {
        return [

            // the name, subject and body attributes are required
            ['password', 'safe'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            [['name', 'email'], 'string', 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
        ];
    }

    public function signup(User $user)
    {
        $user->name = $this->name;
        $user->email = $this->email;
        $email = new EmailService();
        $email->sendEmail($user);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save();
    }

    public function brokerEmail(User $user)
    {
        $email = new EmailService();
        $email->SubEmail($user);
        $user->generateAuthKey();
        $user->status = 1;

    }


}

/**
 * @OA\RequestBody(
 *     request="UserCreateForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="UserCreateForm",
 *             type="object",
 *             ref="#/components/schemas/UserCreateForm"
 *         )
 *     )
 * )
 */
