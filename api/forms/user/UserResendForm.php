<?php

namespace api\forms\user;

use api\components\email\EmailService;
use api\components\sms\SMSRequest;
use common\models\User;
use yii\base\DynamicModel;
use yii\base\Model;
use yii\validators\EmailValidator;

/**
 * Class UserResendForm
 *
 * @OA\Schema(
 *     required={"email_or_mobile_number"}
 * )
 */

class UserResendForm extends Model
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
            ['email', 'string', 'max' => 255],
            ['email', 'default', 'value' => null],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'message' => 'This email not found.'],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'filter' => ['status' => User::STATUS_INACTIVE], 'message' => 'This email has already been verified.'],
        ];
    }

    public function resend()
    {
        $user = User::findOne(['email' => $this->email]);
        $email = new EmailService();
        $email->sendEmail($user);
        $user->save();
    }
}

/**
 * @OA\RequestBody(
 *     request="UserResendForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="UserResendForm",
 *             type="object",
 *             ref="#/components/schemas/UserResendForm"
 *         )
 *     )
 * )
 */
