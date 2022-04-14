<?php

namespace api\templates\carrier;

use common\models\Carrier;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="CarrierSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Carrier $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
        ];
    }
}
