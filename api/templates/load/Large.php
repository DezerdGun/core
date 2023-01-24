<?php

namespace api\templates\load;

use common\models\Customer;
use common\models\Load;
use common\models\LoadAdditionalInfo;
use common\models\LoadContainerInfo;
use common\models\Location;
use common\models\User;
use TRS\RestResponse\templates\BaseTemplate;
use yii\db\Query;

/**
 *
 * @OA\Schema(
 *     schema="LoadLarge",
 *     @OA\Property(
 *          property="id",
 *          type="object",
 *          description="Object",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="vessel_eta",
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
 *     ),
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
            'status' => $model->status,
            'customer_id' => [
                Customer::find()
                    ->select('id,type,contact_name,job_title,company_id,contact_info_id')
                   ->asArray()->one()
                ],
            'port_id' => [
                $model->port_id,
                Location::find()
                    ->select('id,name,address_id,location_type,contact_info_id')
                    ->asArray()->one()
                ],
            'consignee_id' => [
                $model->consignee_id,
                Location::find()
                    ->select('id,name,address_id,location_type,contact_info_id')
                    ->asArray()->one()
                ],
            'user_id' => [
                $model->user_id,
                User::find()
                    ->select('id,username,name,email,mobile_number,role')
                    ->where(['id' => $model->user_id])
                    ->asArray()->one()
            ],
        ];
    }
}
