<?php

namespace api\templates\loadbid;

use common\models\LoadBid;
use common\models\LoadBidDetails;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="LoadBidLarge",
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

class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadBid $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'load_id' => [
                $model->load_id,
                LoadBidDetails::find()
                    ->where(['load_bid_id' => $model->load_id])
                    ->all()
            ],
            'carrier_id' => $model->carrier_id,
            'date' => $model->date
        ];
    }
}