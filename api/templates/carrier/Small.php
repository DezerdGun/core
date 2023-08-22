<?php

namespace api\templates\carrier;

use common\models\Carrier;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="CarrierSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="mc",
 *         type="integer"
 *     ),
 *      @OA\Property(
 *         property="dot",
 *         type="integer"
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Carrier $model */
        $model = $this->model;
        $this->result = [
            'carrier_id' => $model->id,
            'user_id' => $model->user_id
        ];
    }
}
