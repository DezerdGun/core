<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\LoadOrdinaryReferenceNumber;
use yii\db\StaleObjectException;

class LoadOrdinaryReferenceNumberRepository implements RepositoryInterface
{

    public function getById($id): LoadOrdinaryReferenceNumber
    {
        if (!$model = LoadOrdinaryReferenceNumber::findOne(['id' => $id])) {
            throw new HttpException(400, 'LoadOrdinaryReferenceNumber is not found.');
        }
        return $model;
    }

    public function create($model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function update(LoadOrdinaryReferenceNumber $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(LoadOrdinaryReferenceNumber $model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException('delete error.');
        }
    }
}