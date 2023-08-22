<?php

namespace api\forms\user;

use api\components\email\EmailService;
use api\components\sms\SMSRequest;
use common\models\User;
use yii\base\DynamicModel;
use yii\validators\EmailValidator;

/**
 * Class UserRecoveryForm
 *
 * @OA\Schema(
 *     required={""}
 * )
 */
class UserRecoveryForm extends \yii\base\Model
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $email;

    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 320],
            ['email', 'default', 'value' => null],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'message' => 'Email address not found.']
        ];
    }

    public function recovery()
    {
        $user = User::findOne(['email' => $this->email]);
        $email = new EmailService();
        $email->sendEmail($user);
        $user->save();
    }

}
/**
 * @OA\RequestBody(
 *     request="UserRecoveryForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="UserRecoveryForm",
 *             type="object",
 *             ref="#/components/schemas/UserRecoveryForm"
 *         )
 *     )
 * )
 */
