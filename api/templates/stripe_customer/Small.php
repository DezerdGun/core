<?php

namespace api\templates\stripe_customer;

use common\models\StripeCustomer;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="StripeCustomerSmall",
 *     @OA\Property(
 *         property="cus_id",
 *         type="string"
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var StripeCustomer $model */
        $model = $this->model;
        $this->result = [
            'cus_id' => $model->cus_id,
        ];
    }
}
