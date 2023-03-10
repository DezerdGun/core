<?php

namespace api\templates\date;


use common\models\Date;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="dateLarge",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *      @OA\Property(
 *         property="vessel_eta",
 *         type="date"
 *     ),
 *      @OA\Property(
 *         property="last_free_day",
 *         type="date"
 *     ),
 *      @OA\Property(
 *         property="discharged_date",
 *         type="date"
 *     ),
 *      @OA\Property(
 *         property="outgate_date",
 *         type="date"
 *     ),
 *      @OA\Property(
 *         property="empty_date",
 *         type="date"
 *     ),
 *      @OA\Property(
 *         property="ingate_ate",
 *         type="date"
 *     ),

 * )
 */

class Large extends BaseTemplate
{

    protected function prepareResult()
    {
        /** @var Date $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'vessel_eta' => $model->vessel_eta,
            'last_free_day' => $model->last_free_day,
            'discharged_date' => $model->discharged_date,
            'outgate_date' => $model->outgate_date,
            'empty_date' => $model->empty_date,
            'ingate_ate' => $model->ingate_ate,
            ];
    }
}
