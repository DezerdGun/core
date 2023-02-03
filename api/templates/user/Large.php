<?php

namespace api\templates\user;

use common\models\User;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="UserLarge",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="username",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="role",
 *         type="string"
 *     ),
 * )
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var User $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email,
            'mobile_number' => $model->mobile_number,
            'role' => $model->role,
        ];
    }
}
