<?php

namespace api\forms\user;

use api\components\email\EmailService;
use api\components\sms\SMSRequest;
use common\models\User;
use yii\base\DynamicModel;
use yii\base\Model;
use yii;
use yii\validators\EmailValidator;

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
    public $email_or_mobile_number;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $password;
    public $email;
    public $mobile_number;

    public function rules()
    {
        return [
            ['email_or_mobile_number', 'validateEmailOrMobilePhone'],

            // the name, subject and body attributes are required
            ['password', 'safe'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    public function signup(User $user)
    {
        $user->name = $this->name;
        $user->email = $this->email;
        $user->mobile_number = $this->mobile_number;
        if ($this->email) {
            $email = new EmailService();
            $email->sendEmail($user);
        } else {
            $smsRequest = new SMSRequest();
            $smsRequest->verify($this->mobile_number);
        }
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save();

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
                ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
                ['email', 'default', 'value' => null],
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
                ['mobile_number', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This mobile number has already been taken.'],
            ]);
            if ($model->hasErrors()) {
                $this->addError('email_or_mobile_number', $model->errors['mobile_number']);
            }
        } else {
            $this->addError('email_or_mobile_number', 'Please enter a valid mobile number or email address.');
        }

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
