<?php

namespace api\templates\chassis_locations;

use common\models\Chassis_locations;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="ChassisLocationsLarge",
 *         @OA\Property(
 *              property="id",
 *              type="integer",
 *              ),
 *                  @OA\Property(
 *                     property="load_id",
 *                     type="integer"
 *                 ),
 *                  @OA\Property(
 *                     property="container_return",
 *                     type="integer"
 *                 ),
 *                  @OA\Property(
 *                     property="chassis-pickup",
 *                     type="integer"
 *                 ),
 *                  @OA\Property(
 *                     property="chassis-termination",
 *                     type="integer"
 *                 ),
 *     ),
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Chassis_locations $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->load_id,
            'chassis_pickup' =>[
               'id' => $model->chassisPickup->id,
                'name' =>  $model->chassisPickup->name,
                'street_address' => $model->chassisPickup->address->street_address,
                'city' => $model->chassisPickup->address->city,
                'location_type' =>  $model->chassisPickup->location_type,
            ],
            'chassis_termination' => [
                'id' => $model->chassisPickup->id,
                'name' =>  $model->chassisPickup->name,
                'street_address' => $model->chassisPickup->address->street_address,
                'city' => $model->chassisPickup->address->city,
                'location_type' =>  $model->chassisPickup->location_type,
            ]
        ];
    }
}
