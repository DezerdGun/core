<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\Log;
use common\models\OrdinaryBid;
use common\models\OrdinaryBidLog;
use yii\db\ActiveQuery;

class OrdinaryBidLogRepository
{
    public function index($ordinary_bid_id): ActiveQuery
    {
        $query = OrdinaryBidLog::find()
            ->joinWith([
                'log' => function(ActiveQuery $query) {
                    $query->from(['log' => Log::tableName()]);
                },
                'ordinaryBid' => function(ActiveQuery $query) {
                    $query->from(['ordinaryBid' => OrdinaryBid::tableName()]);
                }
            ]);
        $query->where([
            'ordinary_bid_id' => $ordinary_bid_id,
            'ordinaryBid.user_id' => \Yii::$app->user->id
        ]);
        $query->orderBy([
            'id' => SORT_ASC
        ]);

        return $query;
    }
    /**
     * @throws HttpException
     */
    public function getByOrdinaryBidId($ordinary_bid_id): \yii\db\ActiveQuery
    {
        if (!$models = OrdinaryBidLog::find(['ordinary_bid_id' => $ordinary_bid_id])->select(['log_id'])->asArray()) {
            throw new HttpException(404, 'Ordinary bid detail is not found.');
        }
        return $models;
    }

    public function create(OrdinaryBidLog $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, [$model->formName() => $model->errors]);
        }
    }
}