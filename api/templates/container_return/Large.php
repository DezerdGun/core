<?php

namespace api\templates\container_return;

use common\models\Container_return;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="ContainerReturnLarge",
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
 *                     property="return_from",
 *                     type="date",
 *                     format="date-time",
 *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
 *                     example="12-12-2021 21:39:00",
 *                     description="12-12-2021 21:39:00"
 *              ),
 *                 @OA\Property(
 *                     property="return_to",
 *                     type="date",
 *                     format="date-time",
 *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
 *                     example="12-12-2021 21:39:00",
 *                     description="12-12-2021 06:39:00"
 *              ),
 *     ),
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Container_return $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'load_id' => $model->load_id,
            'container_return' =>[
                'name' => $model->containerReturn->name,
                'address_id' => $model->containerReturn->address_id,
                'location_type' => $model->containerReturn->location_type
        ],
            'return_from' => $model->return_from,
            'return_to' => $model->return_from,

        ];
    }
}
