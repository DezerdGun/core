<?php

namespace api\templates\tracking;

use common\models\LoadTracking;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="TrackingLarge",
 *     @OA\Property(
 *         property="id",
 *         type="string"
 *     ),
 * )
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadTracking $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
        ];
    }
}
