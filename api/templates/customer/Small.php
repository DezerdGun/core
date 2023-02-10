<?php

namespace api\templates\customer;

use common\models\Customer;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="CustomerSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="company_name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="street_address",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="city",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="state_code",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="zip",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="main_phone_number",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="main_email",
 *         type="string"
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Customer $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'type' => $model->type,
            'company_name' => $model->company->company_name,
            'street_address' => $model->company->address->street_address,
            'city' => $model->company->address->city,
            'state_code' => $model->company->address->state_code,
            'zip' => $model->company->address->zip,
            'main_phone_number' => $model->contactInfo->main_phone_number,
            'main_email' => $model->contactInfo->main_email,
        ];
    }
}
