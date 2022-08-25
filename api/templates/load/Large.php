<?php

namespace api\templates\load;

use common\models\Company;
use common\models\Load;
use common\models\LoadStop;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="LoadLarge",
 *     @OA\Property(
 *         property="id",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="load_type",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="customer_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="port_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="consignee_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="route_type",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="order",
 *         type="string"
 *     ),
 *
 * )
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Load $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'load_stop' => [LoadStop::find()->all()],
            'company' => [
                Company::find()->all()
            ]
        ];
    }
}
