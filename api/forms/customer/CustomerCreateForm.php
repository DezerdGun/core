<?php

namespace api\forms\customer;

use common\models\Customer;
use yii\base\Model;

/**
 * Class CustomerCreateForm
 *
 * @OA\Schema(
 *     required={"user_id"}
 * )
 */
class CustomerCreateForm extends Model
{
    /**
     * @OA\Property(
     *     type="integer"
     * )
     */
    public $user_id;
    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'Customer already exists'],
        ];
    }
}

/**
 * @OA\RequestBody(
 *     request="CustomerCreateForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="CustomerCreateForm",
 *             type="object",
 *             ref="#/components/schemas/CustomerCreateForm"
 *         )
 *     )
 * )
 */
