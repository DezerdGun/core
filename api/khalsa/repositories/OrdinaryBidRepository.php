<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\OrdinaryBid;
use yii\db\StaleObjectException;

class OrdinaryBidRepository
{
    /**
     * @throws HttpException
     */
    public function getById($id): OrdinaryBid
    {
        if (!$model = OrdinaryBid::findOne(['id' => $id, 'user_id' => \Yii::$app->user->id])) {
            throw new HttpException(404, 'Ordinary bid is not');
        }
        return $model;
    }
    /**
     * @throws HttpException
     */
    public function create(OrdinaryBid $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    /**
     * @throws HttpException
     */
    public function update(OrdinaryBid $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     * @throws HttpException
     */
    public function delete(OrdinaryBid $model)
    {
        if (!$model->delete()) {
            throw new HttpException(500,'Deleting error.');
        }
    }
}