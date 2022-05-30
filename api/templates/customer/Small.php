<?php

namespace api\templates\customer;

use common\models\Customer;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="CustomerSmall",
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
        /** @var Customer $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
        ];
    }
}
