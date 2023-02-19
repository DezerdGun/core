<?php

namespace api\templates\carrier;

use common\models\Carrier;
use TRS\RestResponse\templates\BaseTemplate;
use Yii;
/**
 *
 * @OA\Schema(
 *     schema="CarrierLarge",
 *     @OA\Property(
 *         property="user_picture",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="name",
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
 *         property="company_name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="mobile_number",
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
 *         property="scac",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="instagram",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="facebook",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="linkedin",
 *         type="string"
 *     ),
 * )
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Carrier $model */
        $model = $this->model;
        $this->result = [
            'user_picture' => ($model->user->user_picture) ? Yii::$app->params['CDN_URL'] . $model->user->user_picture:null,
            'name' => $model->user->name,
            'mc_number' => $model->company->mc_number,
            'dot' => $model->company->dot,
            'company_name' => $model->company->company_name,
            'email' => $model->user->email,
            'mobile_number' => $model->user->mobile_number,
            'street_address' => $model->company->address->street_address,
            'city' => $model->company->address->city,
            'state_code' => $model->company->address->state_code,
            'zip' => $model->company->address->zip,
            'scac' => $model->scac,
            'instagram' => $model->instagram,
            'facebook' => $model->facebook,
            'linkedin' => $model->linkedin
        ];
    }
}
