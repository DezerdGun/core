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
            'id' => $model->id,
            'load_id' => $model->load_id,
            'chassis_pickup' => $model->chassis_pickup,
            'chassis_termination' => $model->chassis_termination,


        ];
    }
}
