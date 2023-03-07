<?php

namespace api\templates\container_bid;
use common\models\ContainerBid;

/**
 *
 * @OA\Schema(
 *     schema="ContainerBidSmall",
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
        /** @var ContainerBid $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id
        ];
    }
}