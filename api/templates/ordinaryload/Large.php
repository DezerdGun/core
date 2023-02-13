<?php

namespace api\templates\ordinaryload;

use api\templates\ordinaryneed\Small;
use common\models\OrdinaryLoad;
use TRS\RestResponse\templates\BaseTemplate;



/**
 *
 * @OA\Schema(
 *     schema="OrdinaryloadLarge",
 *     @OA\Property(
 *          property="id",
 *          type="object",
 *          description="Object",
 *             @OA\Property(
 *                 property="id",
 *                 type="integer"
 *         ),
 *              @OA\Property(
 *                 property="customer_id",
 *                 type="integer",
 *                 example="1",
 *                 description="1"
 *         ),
 *              @OA\Property(
 *                 property="origin",
 *                 type="integer",
 *                 example="1",
 *                 description="1"
 *         ),
 *              @OA\Property(
 *                 property="destination",
 *                 type="integer",
 *                 example="1",
 *                 description="1"
 *         ),
 *              @OA\Property(
 *                 property="equipment_needed",
 *                 type="integer",
 *                 example="2F",
 *                 description="2F"
 *         ),
 *              @OA\Property(
 *              property="pick_up_date",
 *              type="date",
 *              format="date-time",
 *              pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
 *              example="2022-08-17 08:16:06",
 *              description="2022-09-17T10:40:52Z"
 *              ),
 *     ),
 * )
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var OrdinaryLoad $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'customer_id' => $model->customer_id,
            'originId' => $model->origin,
            'destination' => $model->destination,
            'equipmentNeedId' => $model->equipmentNeed->ordinary_need,
            'pick_up_date' => $model->pick_up_date,
        ];
    }
}

