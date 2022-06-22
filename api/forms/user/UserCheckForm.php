<?php

namespace api\forms\user;

use api\components\email\EmailService;
use api\components\HttpException;
use api\components\sms\SMSRequest;
use common\models\User;
use yii\base\DynamicModel;
use yii\base\Model;
use yii\validators\EmailValidator;

/**
 * Class UserCheckForm
 *
 * @OA\Schema(
 *     required={"email_or_mobile_number","confirm_code"}
 * )
 */

class UserCheckForm extends Model
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $email_or_mobile_number;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $confirm_code;
    public $mobile_number;
    public $email;
    private $_user;

    public function rules()
    {
        return [
            [['email_or_mobile_number', 'confirm_code',], 'required'],

            ['email_or_mobile_number', 'validateEmailOrMobilePhone'],

            [['email_or_mobile_number', 'confirm_code'], 'string'],

            ['confirm_code', 'exist', 'targetClass' => '\common\models\User', 'message' => 'Wrong verification code.', 'when' => function ($model){
                $user = User::findOne(['email' => $model->email]);
                if ($user && $user->status == User::STATUS_INACTIVE)
                    return true;
                else
                    return false;
            }],
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

    public function status()
    {
        if ($this->email) {
            $user = User::findOne(['confirm_code' => $this->confirm_code]);
            $user->status = User::STATUS_ACTIVE;
            $user->confirm_code = null;
            $user->save();
        } else {
            $smsRequest = new SMSRequest();
            $response = $smsRequest->verifyCheck($this);
            if ($response['status'] == SMSRequest::STATUS_SUCCESS && $user = $this->getUser()) {
                $user->status = User::STATUS_ACTIVE;
                return $user->save();
            }
            else {
                return false;
            }
        }

    }

    /**
     * Finds user by [[mobile_number]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByMobileNumber($this->mobile_number, User::STATUS_INACTIVE);
        }

        return $this->_user;
    }


}

/**
 *   @OA\RequestBody(
 *     request="UserCheckForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="UserCheckForm",
 *             type="object",
 *             ref="#/components/schemas/UserCheckForm"
 *         )
 *     )
 * )
 */
