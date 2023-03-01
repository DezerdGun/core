<?php

namespace api\templates\load;


use common\models\Load;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadLarge",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
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
 *     @OA\Property(
 *         property="user_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="pick_up_from",
 *         type="date"
 *     ),
 *     @OA\Property(
 *         property="pick_up_to",
 *         type="date"
 *     ),
 *    @OA\Property(
 *         property="delivery_from",
 *         type="date"
 *     ),
 *     @OA\Property(
 *         property="delivery_to",
 *         type="date"
 *     ),
 *     @OA\Property(
 *         property="vessel_eta",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *          property="container_info",
 *          type="object",
 *     @OA\Property(
 *         property="owner_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="vessel_name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="mbl",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="hbl",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="container_name",
 *         type="integer"
 *     ),
 *    @OA\Property(
 *         property="load_reference_name",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="size",
 *         type="integer"
 *     ),
 *      ),
 *      @OA\Property (
 *          property="additional_info",
 *          type="object",
 *      @OA\Property(
 *         property="hazmat",
 *         type="string"
 *      ),
 *      @OA\Property(
 *         property="overweight",
 *         type="string"
 *      ),
 *      @OA\Property(
 *         property="reefer",
 *         type="string"
 *      ),
 *      @OA\Property(
 *         property="alcohol",
 *         type="string"
 *      ),
 *      @OA\Property(
 *         property="urgent",
 *         type="string"
 *      ),
 *      @OA\Property(
 *         property="note_from_broker",
 *         type="text"
 *      ),
 *      @OA\Property(
 *         property="hazmat_description",
 *         type="string"
 *      ),
 *      @OA\Property(
 *         property="weight_in_lbs",
 *         type="string"
 *      ),
 *      @OA\Property(
 *         property="temp_in_f",
 *         type="string"
 *      ),
 *      @OA\Property(
 *         property="alcohol_description",
 *         type="string"
 *      ),
 *      @OA\Property(
 *         property="urgent_description",
 *         type="string"
 *      ),
 *      )
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
            'id' => $model->id,
            'loadStatus' => $model->status,
            'consignee_id' => $model->consignee->name,
            'portCity' =>  $model->port->address->city,
            'portStateCode' => $model->port->address->state_code,
            'destinationCity' => $model->consignee->address->city,
            'destinationStateCode' => $model->consignee->address->state_code,
            'customer' => $model->customer->company->company_name,
            'vessel_eta' =>$model->date->vessel_eta,
            'loadAdditionalInfo' => [
                'load_id' => $model->loadAdditionalInfos->load_id,
                'hazmat' => $model->loadAdditionalInfos->hazmat,
                'hazmatDescription' => $model->loadAdditionalInfos->hazmat_description,
                'overweight' => $model->loadAdditionalInfos->overweight,
                'reefer' => $model->loadAdditionalInfos->reefer,
                'alcohol' => $model->loadAdditionalInfos->alcohol,
                'alcoholDescription' => $model->loadAdditionalInfos->alcohol_description,
                'urgent' => $model->loadAdditionalInfos->urgent,
                'urgentDescription' => $model->loadAdditionalInfos->urgent_description,
                'weightInLBs' => $model->loadAdditionalInfos->weight_in_lbs,
                'tempInF' => $model->loadAdditionalInfos->temp_in_f,
                'noteFromBroker' => $model->loadAdditionalInfos->note_from_broker,
            ],
            'loadContainerInfo' => [
                'load_id' => $model->loadContainerInfos->load_id,
                'owner' => [
                   'id' => $model->loadContainerInfos->owner->id,
                   'name' => $model->loadContainerInfos->owner->name
                    ],
                'vesselName' => $model->loadContainerInfos->vessel_name,
                'mbl' => $model->loadContainerInfos->mbl,
                'hbl' => $model->loadContainerInfos->hbl,
                'type' => $model->loadContainerInfos->type,
                'container_number' => $model->loadContainerInfos->container_number,
                'loadReferenceNumber' => $model->loadContainerInfos->load_reference_number,
                'size' => $model->loadContainerInfos->size,
            ]
        ];
    }
}
