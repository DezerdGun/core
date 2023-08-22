<?php

namespace api\templates\location;

use common\models\Location;

use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LocationSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="location_type",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="name",
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
 *         property="zip",
 *         type="string"
 *     ),
 * )
 */

class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Location $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'location_type' => $model->location_type,
            'name' => $model->name,
            'street_address' => $model->address->street_address,
            'city' => $model->address->city,
            'state_code' => $model->address->state_code,
            'zip' => $model->address->zip,
        ];
    }
}
