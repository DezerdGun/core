<?php

namespace api\templates\holds_container_info;

use common\models\Holds;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="HoldsLoadContainerInfoLarge",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *      @OA\Property(
 *         property="load_id",
 *         type="integer"
 *                 ),
 *      @OA\Property(
 *         property="customer_hold",
 *         type="string"
 *                 ),
 *       @OA\Property(
 *         property="carrier_hold",
 *         type="string"
 *                 ),
 *        @OA\Property(
 *          property="broker_hold",
 *          type="string"
 *                 ),
 * )
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Holds $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->load_id,
            'freight_hold' => $model->freight_hold,
            'customer_hold' => $model->customer_hold,
            'carrier_hold' => $model->carrier_hold,
            'broker_hold' => $model->broker_hold,
        ];
    }
}
