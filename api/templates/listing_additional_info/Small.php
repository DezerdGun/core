<?php

namespace api\templates\listing_additional_info;

use common\models\ListingAdditionalInfo;

/**
 *
 * @OA\Schema(
 *     schema="ListingAdditionalInfoSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     )
 * )
 */
class Small extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var ListingAdditionalInfo $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id
        ];
    }
}
