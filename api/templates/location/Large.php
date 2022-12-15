<?php

namespace api\templates\location;

use common\models\Location;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="LocationLarge",
 *     @OA\Property(
 *         property="id",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="location_type",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="street_address",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="city",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="state_code",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="zip_code",
 *         type="string"
 *     ),
 * )
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Location $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'name' => $model->name,
            'location_type' => $model->location_type,
            'street_address' => $model->address->street_address,
            'city' => $model->address->city,
            'state_code' => $model->address->state_code,
            'zip_code' => $model->address->zip
        ];
    }
}
