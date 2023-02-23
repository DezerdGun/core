<?php

namespace api\khalsa\repositories;

use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\LoadOrdinaryReferenceNumber;

class LoadOrdinaryReferenceNumberRepository implements RepositoryInterface
{

    public function getById($id): LoadOrdinaryReferenceNumber
    {
        if (!$model = LoadOrdinaryReferenceNumber::findOne(['id' => $id])) {
            throw new NotFoundException('Hold is not found.');
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
            throw new \RuntimeException('Updating error.');
        }
    }
}