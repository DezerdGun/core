<?php

namespace api\templates\container_bid_log;

use common\models\ContainerBidLog;

class Large extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var ContainerBidLog $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'action_date' => $model->log->action_date,
            'detail' => $model->log->detail
        ];

    }
}