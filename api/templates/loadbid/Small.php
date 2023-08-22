<?php

namespace api\templates\loadbid;

use common\models\LoadBid;
use common\models\LoadBidDetails;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="LoadBidSmall",
 *         @OA\Property(
 *              property="id",
 *              type="integer"
 *     ),
 *         @OA\Property(
 *              property="load_bid_id",
 *              type="integer",
 *              ),
 * )
 */

class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadBid $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'load_id' => [
                $model->load_id,
                LoadBidDetails::findBySql('SELECT load_bid_id,charge_code,price,unit_measure,free_units,note_from_carrier FROM load_bid
                INNER JOIN load_bid_details ON load_bid.load_id = load_bid_details.load_bid_id')->one(),
            ],
            'carrier_id' => $model->carrier_id,
            'date' => $model->date
        ];
    }
}