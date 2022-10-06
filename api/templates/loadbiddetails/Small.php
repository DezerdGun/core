<?php

namespace api\templates\loadbiddetails;

use common\models\LoadBid;
use common\models\LoadBidDetails;
use TRS\RestResponse\templates\BaseTemplate;

/**
*
* @OA\Schema(
 *     schema="LoadBidDetailsSmall",
 *         @OA\Property(
 *              property="id",
 *              type="integer"
    *     ),
 *         @OA\Property(
 *              property="load_bid_id",
 *              type="integer",
 *              ),
 *         @OA\Property(
 *              property="charge_code",
 *              type="integer",
 *              ),
 *         @OA\Property(
 *              property="price",
 *              type="number",
 *              ),
 *         @OA\Property(
 *              property="unit_count",
 *              type="integer",
 *              ),
 *         @OA\Property(
 *              property="unit_measure",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="free_units",
 *              type="number",
 *              ),
 *         @OA\Property(
 *              property="notes",
 *              type="string",
 *              ),
 * )
 */

class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadBidDetails $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'load_bid_id' => $model->load_bid_id,
            'charge_code' => $model->charge_code,
            'price' => $model->price,
            'unit_count' => $model->unit_count,
            'unit_measure' => $model->unit_measure,
            'free_units' => $model->free_units,
            'notes' => $model->notes
        ];
    }
}