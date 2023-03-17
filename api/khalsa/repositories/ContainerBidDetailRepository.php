<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\ContainerBidDetail;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\db\StaleObjectException;

class ContainerBidDetailRepository
{
    /**
     * @throws HttpException
     */
    public function getById($id): ContainerBidDetail
    {

        if (!$model = ContainerBidDetail::findOne(['id' => $id]))
        {
            throw new HttpException(404, 'Container bid detail is not found.');
        }
        return $model;
    }
    /**
     * @throws Exception
     */
    public function create($rows)
    {
        Yii::$app->db->createCommand()->batchInsert(ContainerBidDetail::tableName(), ['container_bid_id', 'charge_id', 'measure_id', 'price', 'free_unit'], $rows)->execute();
    }

    /**
     * @throws HttpException
     */
    public function getByContainerBidId($container_bid_id): array
    {
        if (!$model = ContainerBidDetail::findAll(['container_bid_id' => $container_bid_id])) {
            throw new HttpException(404, 'Container bid detail is not found.');
        }
        return $model;
    }

    public function update(ContainerBidDetail $model)
    {
        if (!$model->save()) {
            throw new HttpException(400, [$model->formName() => $model->errors]);
        }
    }

    /**
     * @throws StaleObjectException
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function delete(ContainerBidDetail $model)
    {
        if (!$model->delete()) {
            throw new HttpException(400, [$model->formName() => $model->errors]);
        }
    }
}
