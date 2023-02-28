<?php

namespace api\khalsa\repositories;

use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\LoadReferenceNumber;
use yii\db\StaleObjectException;

class LoadReferenceNumberRepository implements RepositoryInterface
{

    public function getById($id): LoadReferenceNumber
    {
        if (!$model = LoadReferenceNumber::findOne(['load_id' => $id])) {
            throw new NotFoundException('Load is not found.');
        }
        return $model;
    }

    public function create($model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Create error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function update(LoadReferenceNumber $model)
    {
        if (!$model->update()) {
            throw new \RuntimeException('Update error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(LoadReferenceNumber $model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException('delete error.');
        }
    }
}