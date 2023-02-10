<?php

namespace api\templates\listing_ordinary;

use common\models\ListingOrdinary;
use yii\helpers\ArrayHelper;

/**
 *
 * @OA\Schema(
 *      schema="ListingOrdinaryLarge",
 *      @OA\Property(
 *          property="id",
 *          type="integer"
 *      ),
 *      @OA\Property(
 *          property="status",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="origin_city",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="orgin_state_code",
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
 *          property="pick_up",
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
 *          property="email",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="equipment_code",
 *          type="array",
 *          @OA\Items(
 *              type="string"
 *          )
 *      ),
 *      @OA\Property(
 *          property="ordinary_info",
 *          type="object",
 *          @OA\Property(
 *              property="quantity",
 *              type="integer"
 *          ),
 *          @OA\Property(
 *              property="size",
 *              type="integer"
 *          ),
 *          @OA\Property(
 *              property="weight",
 *              type="integer"
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
 *              type="string"
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
        /** @var  ListingOrdinary $model  */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'status' => $model->status,
            'origin_city' => $model->origin->address->city,
            'origin_state_code' => $model->origin->address->state_code,
            'destination_city' => $model->destination->address->city,
            'destination_state_code' => $model->destination->address->state_code,
            'pick_up' => $model->pick_up,
            'assigned' => $model->user->name,
            'contacts' => $model->user->mobile_number,
            'email' => $model->user->email,
            'equipment_code' => ArrayHelper::getColumn(ArrayHelper::toArray($model->ordinaryEquipments, [
                'common\models\OrdinaryEquipment' => [
                    'equipment_code'
                ]
            ]), 'equipment_code'),
            'ordinary_info' => [
                'quantity' => $model->ordinaryInfo->quantity,
                'size' => $model->ordinaryInfo->size,
                'weight' => $model->ordinaryInfo->weight,
            ],
            'additional_info' => [
                'hazmat' => $model->additionalInfo->hazmat_description,
                'overweight' => $model->additionalInfo->overweight_description,
                'reefer' => $model->additionalInfo->reefer_description,
                'alcohol' => $model->additionalInfo->alcohol_description,
                'urgent' => $model->additionalInfo->urgent_description,
                'note' => $model->additionalInfo->note
            ]
        ];
    }
}
