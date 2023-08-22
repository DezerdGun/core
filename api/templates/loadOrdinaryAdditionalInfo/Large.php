<?php

namespace api\templates\loadOrdinaryAdditionalInfo;


use common\models\LoadOrdinaryAdditionalInfo;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;



/**
 *
 * @OA\Schema(
 *     schema="LoadOrdinaryAdditionalInfoLarge",
 *              @OA\Property(
 *                 property="id",
 *                 type="integer"
 *         ),
 *             @OA\Property(
 *                 property="load_id",
 *                 type="integer"
 *         ),
 *             @OA\Property(
 *                 property="hazmat",
 *                 type="string"
 *         ),
 *             @OA\Property(
 *                 property="hazmat_description",
 *                 type="string"
 *         ),
 *             @OA\Property(
 *                 property="overweight",
 *                 type="string"
 *         ),
 *             @OA\Property(
 *                 property="overweight_description",
 *                 type="string"
 *         ),
 *             @OA\Property(
 *                 property="reefer",
 *                 type="string"
 *         ),
 *             @OA\Property(
 *                 property="reefer_description",
 *                 type="string"
 *         ),
 *             @OA\Property(
 *                 property="alcohol",
 *                 type="string"
 *         ),
 *             @OA\Property(
 *                 property="alcohol_description",
 *                 type="string"
 *         ),
 *            @OA\Property(
 *                 property="urgent",
 *                 type="string"
 *         ),
 *           @OA\Property(
 *                 property="urgent_description",
 *                 type="string"
 *         ),
 *           @OA\Property(
 *                 property="note",
 *                 type="string"
 *         ),
 * )
 */

class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadOrdinaryAdditionalInfo $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'loadId' => $model->load_id,
            'hazmat' => $model->hazmat,
            'hazmatDescription' => $model->hazmat_description,
            'overweight' => $model->overweight,
            'overweightDescription' => $model->overweight_description,
            'reefer' => $model->reefer,
            'reeferDescription' => $model->reefer_description,
            'alcohol' => $model->alcohol,
            'alcoholDescription' => $model->alcohol_description,
            'urgent' => $model->urgent,
            'urgentDescription' => $model->urgent_description,
            'note' => $model->note
        ];
    }
}

