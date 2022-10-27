<?php

namespace api\templates\containerinfo;

use common\models\LoadContainerInfo;
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
            'load_id' => $model->load_id,
            'number' => $model->number,
            'size' => $model->size,
            'type' => $model->type,
            'owner' => $model->owner,
            'vessel_name' => $model->vessel_name,
            'mbl' => $model->mbl,
            'hbl' => $model->hbl,
        ];
    }
}
