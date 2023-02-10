<?php

namespace api\templates\customer;

use common\models\Customer;

/**
 *
 * @OA\Schema(
 *     schema="CustomerLarge",
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
 *         property="mc_number",
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
 *         property="contact_name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="job_title",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="main_phone_number",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="additional_phone_number",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="main_email",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="additional_email",
 *         type="string"
 *     ),
 * )
 */
class Large extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var Customer $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'type' => $model->type,
            'company_name' => $model->company->company_name,
            'mc_number' => $model->company->mc_number,
            'dot' => $model->company->dot,
            'ein' => $model->company->ein,
            'street_address' => $model->company->address->street_address,
            'city' => $model->company->address->city,
            'state_code' => $model->company->address->state_code,
            'zip' => $model->company->address->zip,
            'contact_name' => $model->contact_name,
            'job_title' => $model->job_title,
            'main_phone_number' => $model->contactInfo->main_phone_number,
            'additional_phone_number' => $model->contactInfo->additional_phone_number,
            'main_email' => $model->contactInfo->main_email,
            'additional_email' => $model->contactInfo->additional_email,
        ];
    }
}
