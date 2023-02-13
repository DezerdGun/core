<?php

namespace api\templates\load;


use common\models\Load;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadLarge",
 *     @OA\Property(
 *          property="id",
 *          type="object",
 *          description="Object",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="vessel_eta",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="customer_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="port_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="consignee_id",
 *         type="integer"
 *     ),
 *     ),
 * )
 */

class Large extends BaseTemplate
{

    protected function prepareResult()
    {
        /** @var Load $model */
        $model = $this->model;
        $this->result = [
            'Id' => $model->id,
            'loadId' => $model->loadContainerInfos->load_reference_number,
            'loadStatus' => $model->status,
            'portCity' =>  $model->port->address->city,
            'portStateCode' => $model->port->address->state_code,
            'destinationCity' => $model->consignee->address->city,
            'destinationStateCode' => $model->consignee->address->state_code,
            'customer' => $model->customer->company->company_name,
            'vesseleEta' =>$model->vesselEta->vessel_eta,
            'size' => $model->loadContainerInfos->size,
            'owner' => $model->loadContainerInfos->owner,
        ];
    }
}
