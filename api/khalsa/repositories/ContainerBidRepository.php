<?php

namespace api\khalsa\repositories;

use common\models\ContainerBid;
use api\components\HttpException;
use yii\db\StaleObjectException;

class ContainerBidRepository
{
    public function getById($id): ContainerBid
    {
        if (!$model = ContainerBid::findOne(['id' => $id, 'user_id' => \Yii::$app->user->id])) {
            throw new HttpException(404, 'Container bid is not found.');
        }
        return $model;
    }

    public function getByUserId($user_id): array
    {
        if (!$model = ContainerBid::findAll(['user_id' => $user_id])) {
            throw new HttpException(404, 'Container bid is not found.');
        }
        return $model;
    }

    public function create(ContainerBid $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    public function favorite(ContainerBid $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(ContainerBid $model)
    {
        if (!$model->delete()) {
            throw new HttpException(500,'Deleting error.');
        }
    }

    /**
     * @throws HttpException
     */
    public function update(ContainerBid $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Saving error.');
        }
    }
}
