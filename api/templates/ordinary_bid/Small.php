<?php

namespace api\templates\ordinary_bid;

use common\models\OrdinaryBid;

/**
 *
 * @OA\Schema(
 *     schema="OrdinaryBidSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     )
 * )
 */
class Small extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var OrdinaryBid $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id
        ];
    }
}