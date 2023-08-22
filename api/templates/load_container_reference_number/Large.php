<?php

namespace api\templates\load_container_reference_number;

use common\models\LoadReferenceNumber;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadReferenceNumberLarge",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *      @OA\Property(
 *         property="load_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="mbl",
 *         type="string"
 *     ),
 *    @OA\Property(
 *         property="hbl",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="seal",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="vessel_name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="voyage",
 *         type="string"
 *     ),
 *      @OA\Property(
 *         property="purchase_order",
 *         type="string"
 *     ),
 *    @OA\Property(
 *         property="shipment",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="pick_up",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="appointment",
 *         type="string"
 *     ),
 *      )
 *     ),
 * )
 */

class Large extends BaseTemplate
{

    protected function prepareResult()
    {
        /** @var LoadReferenceNumber $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->load->load_id,
            'mbl' => $model->mbl,
            'hbl' => $model->hbl,
            'seal' => $model->seal,
            'vessel_name' => $model->vessel_name,
            'voyage' => $model->voyage,
            'purchase_order' => $model->purchase_order,
            'shipment' => $model->shipment,
            'pick_up' => $model->pick_up,
            'appointment' => $model->appointment,
            'reservation' => $model->reservation,
            'return' => $model->return

        ];
    }
}
