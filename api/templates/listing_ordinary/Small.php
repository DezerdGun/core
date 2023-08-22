<?php
namespace api\templates\listing_ordinary;

use  common\models\ListingOrdinary;

/**
 *
 * @OA\Schema(
 *     schema="ListingOrdinarySmall",
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *     )
 * )
 */
class Small extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var ListingOrdinary $model*/
        $model = $this->model;
        $this->result = [
          'id' => $model->id
        ];
    }
}
