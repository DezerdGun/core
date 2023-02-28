<?php

namespace api\templates\load_ordinary_description;



use common\models\LoadOrdinaryDescription;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadOrdinaryDescriptionLarge",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *                  @OA\Property(
 *                     property="load_id",
 *                     type="integer",
 *                 ),
 *                  @OA\Property(
 *                     property="pallets",
 *                     type="integer",
 *                 ),
 *                  @OA\Property(
 *                     property="pallet_size",
 *                     type="integer",
 *                 ),
 *                  @OA\Property(
 *                     property="weight_LBs",
 *                     type="integer",
 *                 ),
 *      )
 *     ),
 * )
 */

class Large extends BaseTemplate
{

    protected function prepareResult()
    {
        /** @var LoadOrdinaryDescription $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'load_id' => $model->load_id,
            'commodity' => $model->loadOrdinaryDescriptionRows->commodity,
            'description' => $model->loadOrdinaryDescriptionRows->description,
            'pieces' => $model->loadOrdinaryDescriptionRows->pieces,
            'pallets' => $model->loadOrdinaryDescriptionRows->pallets,
            'weight_KGs' => $model->loadOrdinaryDescriptionRows->weight_KGs,
            'weight_LBs' => $model->loadOrdinaryDescriptionRows->weight_LBs,
            'Total' => [
                'pallet_size' => $model->pallet_size,
                'pallets' => $model->pallets,
                'weight_LBs' => $model->weight_LBs,
            ]

        ];
    }
}
