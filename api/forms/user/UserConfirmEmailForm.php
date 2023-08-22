<?php

namespace api\forms\user;

use common\models\User;
use yii\base\Model;

/**
 * Class UserConfirmForm
 *
 * @OA\Schema(
 *     required={"email","confirm_code"}
 * )
 */

class UserConfirmEmailForm extends Model
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

    public function rules()
    {
        return [
            [['email', 'confirm_code',], 'required'],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'message' => 'Email not found.'],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'filter' => ['status' => User::STATUS_INACTIVE], 'message' => 'This email has already been verified.'],
            [['email', 'confirm_code'], 'string'],
            ['confirm_code', 'exist', 'targetClass' => '\common\models\User', 'message' => 'Wrong confirm code.', 'when' => function ($model){
                $user = User::findOne(['email' => $model->email]);
                if ($user && $user->status == User::STATUS_INACTIVE)
                    return true;
                else
                    return false;
            }],

        ];
    }
}

/**
 *   @OA\RequestBody(
 *     request="UserConfirmEmailForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="UserConfirmEmailForm",
 *             type="object",
 *             ref="#/components/schemas/UserConfirmEmailForm"
 *         )
 *     )
 * )
 */
