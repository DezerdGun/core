<?php

namespace api\templates\location;

use common\models\Location;

use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LocationSmall",
 *     @OA\Property(
 *         property="id",
 *         type="string"
 *     ),
 * )
 */

class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Location $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
        ];
    }
}
