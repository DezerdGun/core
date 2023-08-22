<?php

namespace api\templates\loadstop;

use common\models\LoadStop;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadStopSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="port_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="stop_type",
 *         type="string"
 *     ),
 *      @OA\Property(
 *         property="company_id",
 *         type="integer"
 *     ),
 *      @OA\Property(
 *         property="from",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="to",
 *         type="string"
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadStop $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'port_id' => $model->port_id,
            'stop_type' => $model->stop_type,
            'company_id' => $model->company_id,
            'from' => $model->from,
            'to' => $model->to,
        ];
    }
}
