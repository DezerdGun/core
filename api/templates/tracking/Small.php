<?php

namespace api\templates\tracking;

use common\models\LoadTracking;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="TrackingSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="load_id",
 *         type="integer"
 *     ),
 *      *     @OA\Property(
 *         property="created",
 *         type="numbert"
 *     ),
 *      *     @OA\Property(
 *         property="lat",
 *         type="double"
 *     ),
 *      *     @OA\Property(
 *         property="long",
 *         type="double"
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadTracking $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'load_id' => $model->load_id,
            'created' => $model->created,
            'lat' => $model->lat,
            'long' => $model->long,
        ];
    }
}
