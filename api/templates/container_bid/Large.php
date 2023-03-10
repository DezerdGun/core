<?php

namespace api\templates\container_bid;

use common\models\ContainerBid;

class Large extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var ContainerBid $model */
        $model = $this->model;
        $bid_description = [];
        for ($i = 0; $i < count($model->containerBidDetail); $i++) {
            $bid_description[] = [
                'bid_detail_id' => $model->containerBidDetail[$i]->id,
                'charge_name' => $model->containerBidDetail[$i]->charge->name,
                'measure_name' => $model->containerBidDetail[$i]->measure->name,
                'price' => $model->containerBidDetail[$i]->price,
                'free_unit' => $model->containerBidDetail[$i]->free_unit
            ];
        }
        $this->result = [
            'id' => $model->id,
            'broker_name' => $model->listingContainer->user->name,
            'vessel_eta' => $model->listingContainer->vessel_eta,
            'quantity' => $model->quantity,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            'note_from_carrier' => $model->note,
            'is_favorite' => $model->is_favorite,
            'container_info' => [
                'port_city' => $model->listingContainer->port->address->city,
                'port_state_code' => $model->listingContainer->port->address->state_code,
                'destination_city' => $model->listingContainer->destination->address->city,
                'destination_state_code' => $model->listingContainer->destination->address->state_code,
                'container_code' => $model->listingContainer->containerInfo->container_code,
                'size' => $model->listingContainer->containerInfo->size,
                'weight' => $model->listingContainer->containerInfo->weight
            ],
            'additional_info' => [
                'mobile_number' => $model->listingContainer->user->mobile_number,
                'email' => $model->listingContainer->user->email,
                'hazmat' => $model->listingContainer->additionalInfo->hazmat_description,
                'overweight' => $model->listingContainer->additionalInfo->overweight_description,
                'reefer' => $model->listingContainer->additionalInfo->reefer_description,
                'alcohol' => $model->listingContainer->additionalInfo->alcohol_description,
                'urgent' => $model->listingContainer->additionalInfo->urgent_description,
                'note_from_broker' => $model->listingContainer->additionalInfo->note,
            ],
            'bid_detail' => $bid_description,
        ];
    }
}