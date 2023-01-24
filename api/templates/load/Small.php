<?php

namespace api\templates\load;

use common\models\Company;
use common\models\Customer;
use common\models\Load;
use common\models\LoadAdditionalInfo;
use common\models\LoadContainerInfo;
use common\models\LoadStop;
use common\models\Location;
use common\models\User;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadSmall",
 *     @OA\Property(
 *          property="id",
 *          type="object",
 *          description="Object",
 *             @OA\Property(
 *                 property="customer_id",
 *                 type="integer"
 *         ),
 *             @OA\Property(
 *                 property="port_id",
 *                 type="integer"
 *         ),
 *              @OA\Property(
 *                 property="consignee_id",
 *                 type="integer"
 *         ),
 *               @OA\Property(
 *                 property="vessel_eta",
 *                 type="integer"
 *         ),
 *         ),
 *            @OA\Property(
 *                 property="from",
 *                 type="string"
 *         ),
 *            @OA\Property(
 *                 property="to",
 *                 type="string"
 *         ),
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Load $model */
        $model = $this->model;
        $this->result = [
            'id' => [
                $model->id,
                LoadContainerInfo::find()->where(['load_id' => $model->id])->asArray()->all(),
                LoadAdditionalInfo::find()
                    ->where(['load_id' => $model->id])->asArray()->all(),
            ],
            'status' => $model->status,
            'customer_id' => [
                $model->customer_id,
                Customer::find()
                    ->where(['id' => $model->customer_id])
                    ->select('id,type,contact_name,job_title,company_id,contact_info_id')
                    ->asArray()
                    ->all()
            ],
            'port_id' => [
                $model->port_id,
                Location::find()
                    ->where(['id' => $model->port_id])
                    ->select('id,name,address_id,location_type,contact_info_id')
                    ->asArray()
                    ->all()
            ],
            'consignee_id' => [
                $model->consignee_id,
                Location::find()
                    ->where([
                        'id' => $model->consignee_id
                    ])->select('id,name,address_id,location_type,contact_info_id')
                    ->asArray()
                    ->all()
            ],
            'vessel_eta' => $model->vessel_eta,
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
