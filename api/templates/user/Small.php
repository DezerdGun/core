<?php

namespace api\templates\user;

use common\models\User;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="UserSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="user_picture",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="name",
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
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var User $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'user_picture' => ($model->user_picture) ? \Yii::$app->params['CDN_URL'] . $model->user_picture : null,
            'name' => $model->name,
            'email' => $model->email,
            'role' => $model->role
        ];
    }
}
