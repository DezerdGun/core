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
    public $email_or_mobile_number;
    public $email;
    public $mobile_number;

    public function rules()
    {
        return [
            ['email_or_mobile_number', 'validateEmailOrMobilePhone']
        ];
    }

    /**
     * @throws yii\base\InvalidConfigException
     */
    public function validateEmailOrMobilePhone()
    {
        $validator = new EmailValidator();

        //return true if it is valid email otherwise false
        if ($validator->validate($this->email_or_mobile_number)) {
            $this->email = $this->email_or_mobile_number;
            $model = DynamicModel::validateData(['email' => $this->email], [
                ['email', 'trim'],
                ['email', 'email'],
                ['email', 'string', 'max' => 320],
                ['email', 'default', 'value' => null],
                ['email', 'exist', 'targetClass' => '\common\models\User', 'message' => 'This email not found.'],
                ['email', 'exist', 'targetClass' => '\common\models\User', 'filter' => ['status' => User::STATUS_INACTIVE], 'message' => 'This email has already been verified.'],
            ]);
            if ($model->hasErrors()) {
                $this->addError('email_or_mobile_number', $model->errors['email']);
            }
        } else if (preg_match('/^(998)[0-9]{9}$/', $this->email_or_mobile_number) ) {
            $this->mobile_number = $this->email_or_mobile_number;
            $model = DynamicModel::validateData(['mobile_number' => $this->email_or_mobile_number], [
                ['mobile_number', 'trim'],
                ['mobile_number', 'default', 'value' => null],
                ['mobile_number', 'string'],
                ['mobile_number', 'match', 'pattern' => '/^(998)[0-9]{9}$/'],
                ['mobile_number', 'exist', 'targetClass' => '\common\models\User', 'message' => 'This mobile number not found.'],
                ['mobile_number', 'exist', 'targetClass' => '\common\models\User', 'filter' => ['status' => User::STATUS_INACTIVE], 'message' => 'This mobile number has already been verified.'],
            ]);
            if ($model->hasErrors()) {
                $this->addError('email_or_mobile_number', $model->errors['mobile_number']);
            }
        } else {
            $this->addError('email_or_mobile_number', 'Please enter a valid mobile number or email address.');
        }

    }

    public function resend()
    {
        if ($this->email) {
            $user = User::findOne(['email' => $this->email]);
            $email = new EmailService();
            $email->sendEmail($user);
            $user->save();
        } else {
            $smsRequest = new SMSRequest();
            $smsRequest->verify($this->mobile_number);
        }
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
