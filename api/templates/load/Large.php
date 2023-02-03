<?php

namespace api\templates\load;


use common\models\Load;
use TRS\RestResponse\templates\BaseTemplate;


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
            'ID' => $model->id,
            'Load ID' =>(new \yii\db\Query())
                ->select(['load_reference_number'])
                ->from('load_container_info')
                ->where(['load_id' => $model->id])
                ->all(),
            'Load status' => $model->status,
            'Port' =>
                [
                    $model->port->address->city,
                    $model->port->address->state_code,
                ],
            'Destination' => [
                $model->consignee->address->city,
                $model->consignee->address->state_code,
            ],
            'Customer' => [
                $model->customer->company->company_name,
            ],
            'Vessel ETA' => [
                $model->vesselEta->vessel_eta,
            ],
            'container_number'=>
            [
                (new \yii\db\Query())
                    ->select(['container_number'])
                    ->from('load_container_info')
                    ->where(['load_id' => $model->id])
                    ->all(),
            ],


            'Size' =>
                (new \yii\db\Query())
                    ->select(['size'])
                    ->from('load_container_info')
                    ->where(['load_id' => $model->id])
                    ->all(),
        ];
    }
}
