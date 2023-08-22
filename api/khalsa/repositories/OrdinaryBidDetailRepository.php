<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\OrdinaryBidDetail;
use Yii;
use yii\db\Exception;

class OrdinaryBidDetailRepository
{
    /**
     * @throws HttpException
     */
    public function getById($id)
    {
        if (!$model = OrdinaryBidDetail::findOne(['id' => $id])) {
            throw new HttpException(404, 'Ordinary bid detail is not found.');
        }
        return $model;
    }

    /**
     * @throws Exception
     */
    public function create($rows)
    {
        Yii::$app->db->createCommand()->batchInsert(OrdinaryBidDetail::tableName(), ['ordinary_bid_id', 'charge_id', 'measure_id', 'price', 'free_unit'], $rows)->execute();
    }

    /**
     * @throws HttpException
     */
    public function getByOrdinaryBidId($ordinary_bid_id): array
    {
        if (!$model = OrdinaryBidDetail::findAll(['ordinary_bid_id' => $ordinary_bid_id])) {
            throw new HttpException(404, 'Ordinary bid detail is not found.');
        }
        return $model;
    }

    public function update(OrdinaryBidDetail $model)
    {
        if (!$model->save()) {
            throw new HttpException(400, [$model->formName() => $model->errors]);
        }
    }

    public function delete(OrdinaryBidDetail $model)
    {
        if (!$model->delete()) {
            throw new HttpException(400, [$model->formName() => $model->errors]);
        }
    }
}