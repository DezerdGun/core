<?php

namespace api\templates\billing;

use common\models\Billing;
/**
 *
 * @OA\Schema(
 *     schema="BillingSmall",
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
        /** @var Billing $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id
        ];
    }
}