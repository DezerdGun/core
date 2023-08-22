<?php
namespace api\templates\listing_container_info;
use \common\models\ListingContainerInfo;
/**
 *
 * @OA\Schema(
 *     schema="ListingContainerInfoSmall",
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
        /** @var ListingContainerInfo $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id
        ];
    }
}
