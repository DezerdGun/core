<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\Container;
use common\models\ContainerBidLog;
use common\models\Log;
use yii\db\ActiveQuery;

class ContainerBidLogRepository
{
    public function index($container_bid_id): ActiveQuery
    {
        $query = ContainerBidLog::find()
            ->joinWith([
                'log' => function(ActiveQuery $query) {
                    $query->from(['log' => Log::tableName()]);
                }
            ]);
        $query->where(['container_bid_id' => $container_bid_id]);
        $query->orderBy([
            'id' => SORT_ASC
        ]);

        return $query;
    }
    /**
     * @throws HttpException
     */
    public function getByContainerBidId($container_bid_id): \yii\db\ActiveQuery
    {
        if (!$models = ContainerBidLog::find(['container_bid_id' => $container_bid_id])->select(['log_id'])->asArray()) {
            throw new HttpException(404, 'Container bid detail is not found.');
        }
        return $models;
    }

    public function create(ContainerBidLog $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, [$model->formName() => $model->errors]);
        }
    }
}