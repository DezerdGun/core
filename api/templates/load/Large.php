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
 *         property="note",
 *         type="text"
 *      ),
 *      @OA\Property(
 *         property="hazmat_description",
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
            'load_id' => $model->load_reference_number,
            'loadStatus' => $model->status,
            'port' => [
                $model->port
            ],
            'portAddress' =>[
                $model->port->address
            ],
            'destination' => [
                $model->consignee
            ],
            'destinationAddress' => $model->consignee->address,
            'date' => [
               'id' => $model->dates->id,
                'last_free_day' =>  $model->dates->last_free_day,
                'discharged_date' =>  $model->dates->discharged_date,
                'outgate_date' => $model->dates->outgate_date,
                'empty_date' => $model->dates->empty_date,
                'ingate_ate' => $model->dates->ingate_ate,
            ],
            'customer' => [
               'id' => $model->customer->id,
               'type' => $model->customer->type,
               'contact_name' => $model->customer->contact_name,
               'job_title' => $model->customer->job_title,

                ],
            'company_name' => $model->customer->company->company_name,
            'vessel_eta' =>$model->vessel_eta,
            'created_by' => [
                'name' => $model->user->name,
                "email" =>  $model->user->email,
                'role' =>  $model->user->role,
            ],
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
                'noteFromBroker' => $model->loadAdditionalInfos->note,
            ],
            'loadContainerInfo' => [
                'load_id' => $model->loadContainerInfos->load_id,
                'owner' => [
                   'id' => $model->loadContainerInfos->owner->id,
                   'name' => $model->loadContainerInfos->owner->name
                    ],
                'vesselName' => $model->loadContainerInfos->loadReferenceNumbers->vessel_name,
                'mbl' => $model->loadContainerInfos->loadReferenceNumbers->mbl,
                'hbl' => $model->loadContainerInfos->loadReferenceNumbers->hbl,
                'type' => $model->loadContainerInfos->type,
                'container_number' => $model->loadContainerInfos->container_number,
                'size' => $model->loadContainerInfos->size,
                'chassis' => $model->loadContainerInfos->chassis,
                'chassis_type' => $model->loadContainerInfos->chassis_type,
                'chassis_size' => $model->loadContainerInfos->chassis_size,
                'chassis_genset' => $model->loadContainerInfos->chassis_genset,
                'voyage' => $model->loadContainerInfos->loadReferenceNumbers->voyage,
                'purchase_order' => $model->loadContainerInfos->loadReferenceNumbers->purchase_order,
                'shipment' => $model->loadContainerInfos->loadReferenceNumbers->shipment,
                'pick_up' => $model->loadContainerInfos->loadReferenceNumbers->pick_up,
                'appointment' => $model->loadContainerInfos->loadReferenceNumbers->appointment,
                'return' => $model->loadContainerInfos->loadReferenceNumbers->return,
                'reservation' => $model->loadContainerInfos->loadReferenceNumbers->reservation,
                'weight_in_LBs' => $model->loadContainerInfos->weight_in_LBs,
            ]
        ];
    }
}
