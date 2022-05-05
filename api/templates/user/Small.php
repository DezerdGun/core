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
        ];
    }
}