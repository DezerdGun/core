<?php

namespace api\templates\ordinary_bid;

use common\models\OrdinaryBid;

class Large extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var OrdinaryBid $model */
        $model = $this->model;
        $bid_description = [];
        for ($i = 0; $i < count($model->ordinaryBidDetail); $i++) {
            $bid_description[] = [
                'bid_detail_id' => $model->ordinaryBidDetail[$i]->id,
                'charge' => [
                    'charge_id' => $model->ordinaryBidDetail[$i]->charge->id,
                    'charge_name' => $model->ordinaryBidDetail[$i]->charge->name
                ],
                'measure' => [
                    'measure_id' => $model->ordinaryBidDetail[$i]->measure->id,
                    'measure_name' => $model->ordinaryBidDetail[$i]->measure->name,
                ],
                'price' => $model->ordinaryBidDetail[$i]->price,
                'free_unit' => $model->ordinaryBidDetail[$i]->free_unit
            ];
        }
        $this->result = [
            'id' => $model->id,
            'broker_name' => $model->listingOrdinary->user->name,
            'pick_up' => $model->listingOrdinary->pick_up,
            'created_at' => date('c', $model->created_at),
            'updated_at' => date('c', $model->updated_at),
            'note_from_carrier' => $model->note,
            'is_favorite' => $model->is_favorite,
            'ordinary_info' => [
                'origin_city' => $model->listingOrdinary->origin->address->city,
                'origin_state_code' => $model->listingOrdinary->origin->address->state_code,
                'destination_city' => $model->listingOrdinary->destination->address->city,
                'destination_state_code' => $model->listingOrdinary->destination->address->state_code,
                'size' => $model->listingOrdinary->ordinaryInfo->size,
                'weight' => $model->listingOrdinary->ordinaryInfo->weight
            ],
            'additional_info' => [
                'mobile_number' => $model->listingOrdinary->user->mobile_number,
                'email' => $model->listingOrdinary->user->email,
                'hazmat' => $model->listingOrdinary->additionalInfo->hazmat_description,
                'overweight' => $model->listingOrdinary->additionalInfo->overweight_description,
                'reefer' => $model->listingOrdinary->additionalInfo->reefer_description,
                'alcohol' => $model->listingOrdinary->additionalInfo->alcohol_description,
                'urgent' => $model->listingOrdinary->additionalInfo->urgent_description,
                'note_from_broker' => $model->listingOrdinary->additionalInfo->note,
            ],
            'bid_detail' => $bid_description,

        ];
    }
}