<?php

namespace api\templates\broker;

use common\models\Broker;
use common\models\User;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="BrokerLarge",
 *         @OA\Property(
 *              property="id",
 *              type="integer"
 *         ),
 *         @OA\Property(
 *              property="user_picture",
 *              type="string",
 *         ),
 *         @OA\Property(
 *              property="name",
 *              type="string",
 *         ),
 *         @OA\Property(
 *              property="email",
 *              type="string",
 *         ),
 *         @OA\Property(
 *              property="mobile_number",
 *              type="string",
 *         ),
 *         @OA\Property(
 *              property="company_name",
 *              type="string",
 *         ),
 *         @OA\Property(
 *              property="dot",
 *              type="string",
 *         ),
 *         @OA\Property(
 *              property="city",
 *              type="string",
 *         ),
 *         @OA\Property(
 *              property="street_address",
 *              type="string",
 *         ),
 *         @OA\Property(
 *              property="state_code",
 *              type="string",
 *         ),
 *         @OA\Property(
 *              property="zip",
 *              type="string",
 *         ),
 * )
 */

class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Broker $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'user_picture' => $model->user->user_picture,
            'name' => $model->user->name,
            'email' => $model->user->email,
            'mobile_number' => $model->user->mobile_number,
            'company_name' => $model->company->company_name,
            'dot' => $model->company->dot,
            'city' => $model->company->address->city,
            'street_address' => $model->company->address->street_address,
            'state_code' => $model->company->address->state_code,
            'zip' => $model->company->address->zip
        ];
    }
}
