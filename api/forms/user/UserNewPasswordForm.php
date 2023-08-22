<?php

namespace api\forms\user;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Class UserNewPasswordForm
 *
 * @OA\Schema(
 *     required={""}
 * )
 */
class UserNewPasswordForm extends Model
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
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $new_password;

    public function rules()
    {
        return [
            [['email', 'confirm_code', 'new_password'], 'required'],
            [['email', 'confirm_code', 'new_password'], 'string'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'message' => 'Email not found.'],
            ['confirm_code', 'validateConfirmCode'],
            ['new_password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    public function validateConfirmCode($attribute)
    {
        $confirm_code = Yii::$app->cache->get($this->email);
        if ($confirm_code != $this->confirm_code) {
            $this->addError($attribute, 'Incorrect verification code.');
        }
    }

    public function newPassword()
    {
        $user = User::findOne(['email'=> $this->email]);
        $user->setPassword($this->new_password);
        $user->generateAuthKey();
        $user->save();
    }
}
/**
 * @OA\RequestBody(
 *     request="UserNewPasswordForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="UserNewPasswordForm",
 *             type="object",
 *             ref="#/components/schemas/UserNewPasswordForm"
 *         )
 *     )
 * )
 */
