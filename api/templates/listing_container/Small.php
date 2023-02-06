<?php
namespace api\templates\listing_container;

use \common\models\ListingContainer;

/**
 *
 * @OA\Schema(
 *     schema="ListingContainerSmall",
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
        /** @var ListingContainer $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id
        ];
    }
}
