<?php

namespace api\forms\user;

use common\models\User;
use yii\base\Model;

/**
 * Class UserCheckForm
 *
 * @OA\Schema(
 *     required={"mobile_number","code"}
 * )
 */

class UserCheckForm extends Model
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $mobile_number;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $code;
    private $_user;

    public function rules()
    {
        return [
            [['mobile_number', 'code',], 'required'],
            ['mobile_number', 'exist', 'targetClass' => '\common\models\User', 'message' => 'This mobile number does not exist.'],
            ['mobile_number', 'exist', 'targetClass' => '\common\models\User', 'filter' => ['status' => User::STATUS_INACTIVE], 'message' => 'This mobile number has already been verified.'],
            [['mobile_number', 'code'], 'string'],
            ['code', 'match', 'pattern' => '/[0-9]{4}$/'],
        ];
    }

    public function status()
    {
        $user = $this->getUser();
        $user->status = User::STATUS_ACTIVE;
        return $user->save();
    }

    /**
     * Finds user by [[mobile_number]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByMobileNumber($this->mobile_number);
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
