<?php

namespace api\templates\load_ordinary_reference_number;

use common\models\LoadOrdinaryReferenceNumber;
use common\models\LoadReferenceNumber;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadOrdinaryReferenceNumberLarge",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *                  @OA\Property(
 *                     property="load_id",
 *                     type="integer"
 *                 ),
 *                  @OA\Property(
 *                     property="seal",
 *                     type="string"
 *                 ),
 *                  @OA\Property(
 *                     property="pick_up",
 *                     type="string"
 *                 ),
 *                  @OA\Property(
 *                     property="appointment",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="reservation",
 *                     type="string"
 *                 ),
 *      )
 *     ),
 * )
 */

class Large extends BaseTemplate
{

    protected function prepareResult()
    {
        /** @var LoadOrdinaryReferenceNumber $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'load_id' => $model->load_id,
            'seal' => $model->seal,
            'pick_up' => $model->pick_up,
            'appointment' => $model->appointment,
            'reservation' => $model->reservation,


        ];
    }
}
