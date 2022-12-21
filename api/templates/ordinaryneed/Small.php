<?php

namespace api\templates\ordinaryneed;

use common\models\OrdinaryLoad;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="OrdinarySmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *      @OA\Property(
 *         property="ordinary_need",
 *         type="string"
 *     ),
 * )
 */

class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var OrdinaryLoad $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'equipment_needed' => $model->equipment_need,
        ];
    }
}
