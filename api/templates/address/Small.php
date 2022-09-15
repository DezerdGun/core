<?php

namespace api\templates\address;

use common\models\Address;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="AddressSmall",
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
        /** @var Address $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'street_address' => $model->street_address,
            'city' => $model->city,
            'state_code' => $model->state_code,
            'zip' => $model->zip,
            'country' => $model->country,
        ];
    }
}
