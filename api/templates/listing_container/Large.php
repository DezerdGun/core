<?php

namespace api\templates\listing_container;

use common\models\ListingContainer;
/**
 *
 * @OA\Schema(
 *      schema="ListingContainerLarge",
 *      @OA\Property(
 *          property="id",
 *          type="integer"
 *      ),
 *      @OA\Property(
 *          property="status",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="port_city",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="port_state_code",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="destination_city",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="destination_state_code",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="vessel_eta",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="assigned",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="contacts",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="container_info",
 *          type="object",
 *          @OA\Property(
 *              property="quantity",
 *              type="integer"
 *          ),
 *          @OA\Property(
 *              property="container_code",
 *              type="string"
 *          ),
 *          @OA\Property(
 *              property="size",
 *              type="integer"
 *          ),
 *          @OA\Property(
 *              property="weight",
 *              type="integer"
 *          ),
 *          @OA\Property(
 *              property="owner",
 *              type="string"
 *          )
 *      ),
 *      @OA\Property (
 *          property="additional_info",
 *          type="object",
 *          @OA\Property (
 *              property="hazmat",
 *              type="string"
 *          ),
 *          @OA\Property (
 *              property="overweight",
 *              type="integer"
 *          ),
 *          @OA\Property (
 *              property="reefer",
 *              type="string"
 *          ),
 *          @OA\Property (
 *              property="alcohol",
 *              type="string"
 *          ),
 *          @OA\Property (
 *              property="urgent",
 *              type="string"
 *          ),
 *          @OA\Property (
 *              property="note",
 *              type="string"
 *          )
 *      )
 * )
 */
class Large extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var ListingContainer $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'status' => $model->status,
            'port_city' => $model->port->address->city,
            'port_state_code' => $model->port->address->state_code,
            'destination_city' => $model->destination->address->city,
            'destination_state_code' => $model->destination->address->state_code,
            'vessel_eta' => $model->vessel_eta,
            'assigned' => $model->user->name,
            'contacts' => $model->user->mobile_number,
            'container_info' => [
                'quantity' => $model->containerInfo->quantity,
                'container_code' => $model->containerInfo->container_code,
                'size' => $model->containerInfo->size,
                'weight' => $model->containerInfo->weight,
                'owner' => $model->containerInfo->owner->name,
            ],
            'additional_info' => [
                'hazmat' => $model->additionalInfo->hazmat_description,
                'overweight' => $model->additionalInfo->overweight_description,
                'reefer' => $model->additionalInfo->reefer_description,
                'alcohol' => $model->additionalInfo->alcohol_description,
                'urgent' => $model->additionalInfo->urgent_description,
                'note' => $model->additionalInfo->note
            ],

        ];
    }
}
