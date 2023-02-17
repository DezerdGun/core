<?php

namespace api\templates\containerinfo;

use common\models\Load;
use common\models\LoadContainerInfo;
use common\models\Owner;
use common\models\User;
use OpenApi\Annotations as OA;
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
            'owner' => $model->owner->name,
            'vesselName' => $model->vessel_name,
            'mbl' => $model->mbl,
            'hbl' => $model->hbl,
            'type' => $model->type,
            'container_number' => $model->container_number,
            'loadReferenceNumber' => $model->load_reference_number,
            'size' => $model->size,

        ];
    }
}
