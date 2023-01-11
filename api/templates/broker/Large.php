<?php

namespace api\templates\broker;

use common\models\Broker;
use common\models\User;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="BrokerLarge",
 *         @OA\Property(
 *              property="id",
 *              type="integer"
 *     ),
 *         @OA\Property(
 *              property="master_id",
 *              type="integer",
 *              ),
 * )
 */

class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Broker $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'master_id' => $model->master_id,
            'user_id' => [
                $model->user_id,
                User::find()
                    ->where(['id' => $model->user_id])
                    ->all()
            ],
        ];
    }
}