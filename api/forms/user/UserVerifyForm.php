<?php

namespace api\forms\user;

use common\models\User;
use yii\base\Model;

/**
 * Class UserVerifyForm
 *
 * @OA\Schema(
 *     required={"mobile_number"}
 * )
 */

class UserVerifyForm extends Model
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $mobile_number;

    public function rules()
    {
        return [
            ['mobile_number', 'exist', 'targetClass' => '\common\models\User', 'message' => 'This mobile number does not exist.'],
            ['mobile_number', 'exist', 'targetClass' => '\common\models\User', 'filter' => ['status' => User::STATUS_INACTIVE], 'message' => 'This mobile number has already been verified.'],
            [['mobile_number'], 'required'],
            [['mobile_number'], 'string'],
        ];
    }

}

/**
 * @OA\RequestBody(
 *     request="UserVerifyForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="UserVerifyForm",
 *             type="object",
 *             ref="#/components/schemas/UserVerifyForm"
 *         )
 *     )
 * )
 */
