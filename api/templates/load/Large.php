<?php

namespace api\templates\load;

use api\controllers\LoadContainerInfoController;
use common\models\Load;
use common\models\LoadAdditionalInfo;
use common\models\LoadContainerInfo;
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
 *         property="load_status",
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
 *     @OA\Property(
 *         property="broker_name",
 *         type="string"
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
            'customer_id' => $model->customer_id,
            'port_id' => $model->port_id,
            'consignee_id' => $model->consignee_id,
            'load_status' => $model->load_status,
            'vessel_eta' => $model->vessel_eta,
            'broker_name' => $model->broker_name,
        ];
    }
}
