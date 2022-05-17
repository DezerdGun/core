<?php

namespace api\templates\carrier;

use common\models\Carrier;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="CarrierLarge",
 *     @OA\Property(
 *         property="id",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="mc",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="dot",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="ein",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="w9",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="ic",
 *         type="string"
 *     ),
 *
 * )
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Carrier $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'user_id' => $model->user_id,
            'mc' => $model->mc,
            'dot' => $model->dot,
            'ein' => $model->ein,
            'w9' => $model->w9,
            'ic' => $model->ic,
        ];
    }
}