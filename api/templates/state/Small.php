<?php

namespace api\templates\state;

use common\models\State;

use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="StateSmall",
 *     @OA\Property(
 *         property="State[state_code]",
 *     ),
 * )
 */



class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var State $model */
        $model = State::find();
        $model = $this->model;
        $this->result = [
            'state' => $model->success($model),
        ];
    }
}
