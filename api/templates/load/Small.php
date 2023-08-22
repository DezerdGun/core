<?php

namespace api\templates\load;

use common\models\Customer;
use common\models\Date;
use common\models\Load;
use common\models\LoadAdditionalInfo;
use common\models\LoadContainerInfo;
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
 *              @OA\Property(
 *                 property="load_id",
 *                 type="integer"
 *         ),
 *               @OA\Property(
 *                 property="vessel_eta",
 *                 type="integer"
 *         ),
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
            'ID' => $model->id,
            'Load Id' =>(new \yii\db\Query())
                ->select(['load_reference_number'])
                ->from('load_container_info')
                ->where(['load_id' => $model->id])
                ->all(),
            'status' => $model->status,
            'Port' => [
                (new \yii\db\Query())
                    ->select(['city','state_code'])
                    ->from('address')
                    ->where(['id' => $model->port_id])
                    ->all(),
            ],
            'Destination' => [
                (new \yii\db\Query())
                    ->select(['city','state_code'])
                    ->from('address')
                    ->where(['id' => $model->consignee_id])
                    ->all(),
            ],
            'Customer' => [
                (new \yii\db\Query())
                    ->select(['company_name'])
                    ->from('company')
                    ->where(['id' => $model->customer_id])
                    ->all(),
            ],
            'Vessel ETA' =>
                (new \yii\db\Query())
                    ->select(['vessel_eta'])
                    ->from('date')
                    ->where(['id' => $model->vessel_eta])
                    ->all(),
            'container_number'=>
                (new \yii\db\Query())
                    ->select(['container_number'])
                    ->from('load_container_info')
                    ->where(['load_id' => $model->id])
                    ->all(),
            'Size' =>
                (new \yii\db\Query())
                    ->select(['size'])
                    ->from('load_container_info')
                    ->where(['load_id' => $model->id])
                    ->all(),
        ];

    }
}
