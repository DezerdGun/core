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
 *                     property="commodity",
 *                     type="string",
 *                 ),
 *                  @OA\Property (
 *                      property="description",
 *                      type="array",
 *                      @OA\Items(
 *                          type="string"
 *                      )
 *                  ),
 *                  @OA\Property(
 *                     property="pieces",
 *                     type="integer",
 *                 ),
 *                  @OA\Property(
 *                     property="pallets",
 *                     type="integer",
 *                 ),
 *                  @OA\Property(
 *                     property="weight_KGs",
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
            'commodity' => $model->commodity,
            'description' => $model->description,
            'pieces' => $model->pieces,
            'pallets' => $model->pallets,
            'weight_KGs' => $model->weight_KGs,
            'weight_LBs' => $model->weight_LBs,

        ];
    }
}
