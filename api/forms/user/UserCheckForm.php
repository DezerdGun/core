<?php

namespace api\forms\user;

use api\components\email\EmailService;
use api\components\HttpException;
use api\components\sms\SMSRequest;
use common\models\User;
use yii\base\DynamicModel;
use yii\base\Model;
use yii\validators\EmailValidator;
use Yii;

/**
 * Class UserCheckForm
 *
 * @OA\Schema(
 *     required={"email","confirm_code"}
 * )
 */

class UserCheckForm extends Model
{
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
    public $confirm_code;
    private $_user;

    public function rules()
    {
        return [
            [['email', 'confirm_code',], 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'default', 'value' => null],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'message' => 'This email not found.'],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'filter' => ['status' => User::STATUS_INACTIVE], 'message' => 'This email has already been verified.'],

            [['email', 'confirm_code'], 'string'],
            ['confirm_code', 'validateConfirmCode'],
        ];
    }

    public function validateConfirmCode($attribute)
    {
        $confirm_code = Yii::$app->cache->get($this->email);
        $user = User::findOne(['email' => $this->email]); // This is added cause if email doesn't exist don't show message
        if ($confirm_code != $this->confirm_code && $this->email == $user->email) {
            $this->addError($attribute, 'Incorrect verification code.');
        }
    }

    public function status()
    {
        $user = User::findOne(['email' => $this->email]);
        $user->status = User::STATUS_ACTIVE;
        $user->save();
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
