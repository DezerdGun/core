<?php

namespace api\templates\ordinaryload;

use common\models\OrdinaryLoad;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;
use yii\helpers\ArrayHelper;

/**
     *
     * @OA\Schema(
     *     schema="OrdinaryLoadSmall",
     *     @OA\Property(
     *         property="id",
     *         type="integer"
     *     ),
     *     @OA\Property(
     *         property="origin_id",
     *         type="integer"
     *     ),
     *     @OA\Property(
     *         property="destination_id",
     *         type="integer"
     *     ),
     *     @OA\Property(
     *         property="equipment_need_id",
     *         type="integer"
     *     ),
     *     @OA\Property(
     *         property="pick_up_date",
     *         type="integer"
     *     ),
     *     @OA\Property(
     *         property="status",
     *         type="integer"
     *     ),
     *     @OA\Property (
     *          property="LoadOrdinaryAdditionalInfo",
     *          type="object",
     *      @OA\Property(
     *         property="load_id",
     *         type="integer"
     *      ),
     *      @OA\Property(
     *         property="hazmat",
     *         type="string"
     *      ),
     *       @OA\Property(
     *         property="hazmat_description",
     *         type="string"
     *      ),
     *      @OA\Property(
     *         property="overweight",
     *         type="string"
     *      ),
     *      @OA\Property(
     *         property="overweight_description",
     *         type="string"
     *      ),
     *       @OA\Property(
     *         property="weight_in_LBs",
     *         type="string"
     *      ),
     *       @OA\Property(
     *         property="weight_in_LBs_description",
     *         type="string"
     *      ),
     *       @OA\Property(
     *         property="reefer",
     *         type="string"
     *      ),
     *       @OA\Property(
     *         property="reefer_description",
     *         type="string"
     *      ),
     *        @OA\Property(
     *         property="alcohol",
     *         type="string"
     *      ),
     *        @OA\Property(
     *         property="alcohol_description",
     *         type="string"
     *      ),
     *        @OA\Property(
     *         property="urgent",
     *         type="string"
     *      ),
     *        @OA\Property(
     *         property="urgent_description",
     *         type="string"
     *      ),
     *        @OA\Property(
     *         property="note",
     *         type="string"
     *      ),
     *   ),
     *       @OA\Property (
     *          property="LoadOrdinaryDescription",
     *          type="object",
     *      @OA\Property(
     *          property="load_id",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="pallets",
     *          type="integer"
     *      ),
     *       @OA\Property(
     *          property="weight_LBs",
     *          type="integer"
     *      ),
     *       @OA\Property(
     *          property="pallet_size",
     *          type="string"
     *      ),
     * )
     * )
     */

class Small extends BaseTemplate
{

    protected function prepareResult()
    {
        /** @var OrdinaryLoad $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'port_id' => $model->origin_id,
            'destination_id' => $model->destination_id,
            'ordinary_need' => ArrayHelper::getColumn(ArrayHelper::toArray($model->ordinaryNeededs, [
                'common\models\OrdinaryNeeded' => [
                    'id',
                    'ordinary_need'
                ]
            ]), 'ordinary_need'),
            'pick_up_date' => $model->pick_up_date,
            'status' => $model->status,
            'LoadOrdinaryAdditionalInfo' => [
                'load_id' => $model->loadOrdinaryAdditionalInfos->load_id,
                'hazmat' => $model->loadOrdinaryAdditionalInfos->hazmat,
                'hazmat_description' => $model->loadOrdinaryAdditionalInfos->hazmat_description,
                'overweight' => $model->loadOrdinaryAdditionalInfos->overweight,
                'overweight_description' => $model->loadOrdinaryAdditionalInfos->overweight_description,
                'weight_in_LBs' => $model->loadOrdinaryAdditionalInfos->weight_in_LBs,
                'weight_in_LBs_description' => $model->loadOrdinaryAdditionalInfos->weight_in_LBs_description,
                'reefer' => $model->loadOrdinaryAdditionalInfos->reefer,
                'reefer_description' => $model->loadOrdinaryAdditionalInfos->reefer_description,
                'alcohol' => $model->loadOrdinaryAdditionalInfos->alcohol,
                'alcohol_description' => $model->loadOrdinaryAdditionalInfos->alcohol_description,
                'urgent' => $model->loadOrdinaryAdditionalInfos->urgent,
                'urgent_description' => $model->loadOrdinaryAdditionalInfos->urgent_description,
                'note' => $model->loadOrdinaryAdditionalInfos->note,
            ],
            'LoadOrdinaryDescription'  => [
                'load_id' => $model->loadOrdinaryDescriptions->load_id,
                'pallets' => $model->loadOrdinaryDescriptions->pallets,
                'weight_LBs' => $model->loadOrdinaryDescriptions->weight_LBs,
                'pallets_size' => $model->loadOrdinaryDescriptions->pallet_size
            ]
        ];
    }
}

