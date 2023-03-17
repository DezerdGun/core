<?php

namespace api\templates\ordinary_bid_log;

use common\models\OrdinaryBidLog;

class Large extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var OrdinaryBidLog $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'action_date' => $model->log->action_date,
            'detail' => $model->log->detail
        ];
    }
}