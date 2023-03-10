<?php

namespace api\templates\Date;


use common\models\Date;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="DateLarge",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *      )
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
