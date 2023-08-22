<?php

namespace api\forms\user;
use common\models\User;
use Yii;

/**
 * Class UserChangePassword
 *
 * @OA\Schema(
 *     required={"UserChangePassword"}
 * )
 */
class UserChangePassword extends \yii\base\Model
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $old_password;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $new_password;

    public function rules()
    {
        return  [
            [['old_password', 'new_password'], 'string'],
            ['old_password', 'validateOldPassword']
        ];
    }

    public function validateOldPassword($attribute)
    {
        $password_hash = User::findOne(['id' => \Yii::$app->user->id])->password_hash;
        if (!Yii::$app->getSecurity()->validatePassword($this->old_password, $password_hash)) {
            $this->addError($attribute, 'Incorrect old password.');
        }
    }
}
