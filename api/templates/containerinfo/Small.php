<?php

namespace api\templates\containerinfo;

use common\models\Load;
use common\models\LoadContainerInfo;
use common\models\Owner;
use common\models\User;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadContainerInfoSmall",
 *     @OA\Property(
 *          property="id",
 *          type="object",
 *          description="Object",
 *         @OA\Property(
 *              property="load_id",
 *              type="integer",
 *              ),
 *         @OA\Property(
 *              property="number",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="size",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="type",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="owner",
 *              type="integer",
 *              ),
 *         @OA\Property(
 *              property="vessel_name",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="mbl",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="hbl",
 *              type="string",
 *              ),
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadContainerInfo $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'LoadReferenceNumber' => $model->load_reference_number,
            'load_id' => [
                $model->load_id,
                Load::find()
                    ->select('id,user_id,consignee_id,port_id,customer_id,status,vessel_eta')
                    ->where(['id' => $model->load_id ])
                    ->asArray()->one(),
            ],
            'container_number' => $model->container_number,
            'size' => $model->size,
            'type' => $model->type,
            'owner' => Owner::find()
                        ->select('name')
                        ->where(['id' => $model->owner])
                        ->asArray()->one(),

            'vessel_name' => $model->vessel_name,
            'mbl' => $model->mbl,
            'hbl' => $model->hbl,

        ];
    }
}
