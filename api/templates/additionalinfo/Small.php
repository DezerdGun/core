<?php

namespace api\templates\additionalinfo;

use common\models\LoadAdditionalInfo;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadAdditionalInfoSmall",
 *     @OA\Property(
 *          property="id",
 *          type="object",
 *          description="Object",
 *         @OA\Property(
 *              property="load_id",
 *              type="integer",
 *              ),
 *         @OA\Property(
 *              property="hazmat",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="overweight",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="reefer",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="alcohol",
 *              type="integer",
 *              ),
 *         @OA\Property(
 *              property="urgent",
 *              type="string",
 *              ),
 *         @OA\Property(
 *              property="note_from_broker",
 *              type="string",
 *              ),
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadAdditionalInfo $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'load_id' => $model->load_id,
            'hazmat' => $model->hazmat,
            'overweight' => $model->overweight,
            'reefer' => $model->reefer,
            'alcohol' => $model->alcohol,
            'urgent' => $model->urgent,
            'note_from_broker' => $model->note_from_broker
        ];
    }
}
